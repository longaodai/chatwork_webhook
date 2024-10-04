<?php

namespace service;

use Google\Service\Exception;
use core\Logging;

class ActionService
{
    private string $message;
    private string $content;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function handle()
    {
        try {
            $isAction = false;
            
            foreach($this->listAction() as $key => $action) {
                if (str_contains($this->message, $key)) {
                    $isAction = true;
                }
            }

            if (!$isAction) {
                return $this->callAssistant();
            }

            // [action]: content
            list($action, $content) = explode(':', $this->message);
            $this->content = !empty($content) ? $content : '';

            if (!empty($action) && in_array(trim($action), array_keys($this->listAction()))) {
                return $this->{$this->listAction()[trim($action)]}();
            }

            return $this->getListHelp();
        } catch (\Throwable $throwable) {
            Logging::write("----- ERROR HANDLE ACTION -----: " . $throwable->getMessage());
            
            return $this->getListHelp();
        }
    }

    /**
     * Define list action
     *
     * @return string[]
     */
    private function listAction(): array
    {
        return [
            '[list_help]' => 'getListHelp',
            '[note_money]' => 'noteMoney'
        ];
    }

    private function getListHelp(): string
    {
        return '
|----------------------- LIST KEY ------------------------|
| Show list action: [list_help]                           |
| Save money manager: [note_money]: {target} => {price}   |
|     ex: [note_money]: For breakfast => 1000k            |
|                                                         |
| Contact: https://chatwork-webhook.hioncoding.com        |
|---------------------------------------------------------|
        ';
    }

    /**
     * @return string
     *
     * @throws \Google\Exception
     */
    private function noteMoney(): string
    {
        // content = Breakfast => 100k
        list($target, $price) = explode('=>', $this->content);
        $target = trim($target);
        $price = !empty($price) ? filter_var(trim($price), FILTER_SANITIZE_NUMBER_INT) : 0;
        $sheetName = PREFIX_SHEET_MONEY_MANAGER . date('m');
        $sheetService = new GoogleSheetService(CHATWORK_GOOGLE_SHEET_ID, $sheetName);
        $data = [
            date('Y-m-d H:i:s'),
            $target,
            $price,
        ];

        try {
            $sheetService->appendRow($data);

            return "Save money $target $price successfully!";
        } catch (\Throwable $throwable) {
            $messageError = $throwable->getMessage();

            return "Save money $target $price failed! $messageError";
        }
    }

    /**
     * @return string
     */
    private function callAssistant()
    {
        try {
            $geminiService = new Gemini();

            return $geminiService->sendRequest($this->message);
        } catch (\Throwable $throwable) {
            $messageError = $throwable->getMessage();

            return "Call assistant failed! $messageError";
        }
    }
}
