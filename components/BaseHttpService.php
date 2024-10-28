<?php

namespace app\components;

use yii\httpclient\Client;

abstract class BaseHttpService
{
    protected $client;

    public function __construct($base_url) {
        $this->client = new Client([
            'baseUrl' => $base_url,
            'requestConfig' => [
                'format' => Client::FORMAT_JSON
            ],
            'responseConfig' => [
                'format' => Client::FORMAT_JSON
            ],
        ]);
    }
}