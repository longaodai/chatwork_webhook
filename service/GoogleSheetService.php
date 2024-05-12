<?php

namespace service;

use Google\Exception;
use Google_Client;
use Google_Service_Sheets;

class GoogleSheetService
{
    private Google_Client $client;
    private Google_Service_Sheets $service;
    private string $spreadsheetId;
    private string $sheet_name;

    /**
     * @throws Exception
     */
    public function __construct($spreadsheetId, $sheet_name)
    {
        $this->client = new Google_Client();
        $this->client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $this->client->setAuthConfig(CHATWORK_GOOGLE_SHEET_AUTH);
        $this->spreadsheetId = $spreadsheetId;
        $this->sheet_name = $sheet_name;
        $this->service = new Google_Service_Sheets($this->client);
    }

    public function getClient(): Google_Client
    {
        return $this->client;
    }

    public function getService(): Google_Service_Sheets
    {
        return $this->service;
    }

    /**
     * @throws \Google\Service\Exception
     */
    public function appendRow($data)
    {
        $rows = [$data];
        $valueRange = new \Google_Service_Sheets_ValueRange();
        $valueRange->setValues($rows);
        $range = $this->sheet_name;
        $options = ['valueInputOption' => 'USER_ENTERED'];
        $this->service->spreadsheets_values->append($this->spreadsheetId, $range, $valueRange, $options);
    }
}
