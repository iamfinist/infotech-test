<?php

namespace app\components;

use Throwable;

class SmsService extends BaseHttpService
{
    private $api_key;
    public function __construct()
    {
        $base_url = 'https://smspilot.ru/api.php';
        $this->api_key = 'XXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZXXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZ';
        parent::__construct($base_url);
    }

    public function send($phone_number, $text) {

        try {
            $request = $this->client->get('', [
                'send' => $text,
                'to' => $phone_number,
                'apikey' => $this->api_key
            ]);

            $response = $request->send();
        } catch (Throwable $exception) {
            return false;
        }

        if ($response->statusCode == 200) {
            return true;
        }

        return false;

    }
}