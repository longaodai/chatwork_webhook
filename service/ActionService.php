<?php

namespace service;

use Google\Service\Exception;

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
        // [action]: content
        list($action, $content) = explode(':', $this->message);
        $this->content = $content;

        if (!empty($action) && in_array(trim($action), array_keys($this->listAction()))) {
            return $this->{$this->listAction()[trim($action)]}();
        }

        return $this->message;
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
}
