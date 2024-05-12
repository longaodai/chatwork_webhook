<?php

if (!defined('APP_ENVIRONMENT')) {
    define('APP_ENVIRONMENT', 'local'); // 'pro', 'dev', 'local'
}

if (!defined('CHAT_WORK_DEFAULT_ROOM_ID')) {
    define('CHAT_WORK_DEFAULT_ROOM_ID', '');
}

if (!defined('CHAT_WORK_DEFAULT_ROOM_ID')) {
    define('CHAT_WORK_DEFAULT_ROOM_ID', '');
}

if (!defined('CHAT_WORK_API_TOKEN')) {
    define('CHAT_WORK_API_TOKEN', '');
}

if (!defined('CHAT_GPT_API_TOKEN')) {
    define('CHAT_GPT_API_TOKEN', '');
}

if (!defined('GEMINI_API_TOKEN')) {
    define('GEMINI_API_TOKEN', '');
}

if (!defined('CHATWORK_GOOGLE_SHEET_ID')) {
    define('CHATWORK_GOOGLE_SHEET_ID', '');
}

if (!defined('CHATWORK_GOOGLE_SHEET_AUTH')) {
    define('CHATWORK_GOOGLE_SHEET_AUTH', [
        "type" => "service_account",
        "project_id" => "",
        "private_key_id" => "",
        "private_key" => "",
        "client_email" => "",
        "client_id" => "",
        "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
        "token_uri" => "https://oauth2.googleapis.com/token",
        "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
        "client_x509_cert_url" => "",
        "universe_domain" => "googleapis.com"
    ]);
}
