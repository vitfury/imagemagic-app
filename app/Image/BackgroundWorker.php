<?php

namespace App\Image;

use GuzzleHttp\Client;
use League\Flysystem\Config;

class BackgroundWorker
{
    private $client;

    public function __construct()
    {

        $workerUrl = "http://" . config('worker.domain');
        $this->client = (new Client(['base_uri' => $workerUrl]));
    }

    /**
     * return array
     */
    public function remove($encodedImageContent)
    {
        try {
            $response = $this->client->request('POST', '', [
                'body' => json_encode([
                    'source' => $encodedImageContent,
                    'processId' => date('U')
                ])
            ]);
            $response = $response->getBody();
            $body = json_decode($response, true);
            if(!$body['result'] || empty($body['data']['content'])) {
                throw new Exception('False result. Error - '. $body);
            }
            return $body['data']['content'];
        } catch (\Throwable $e) {
            die($e->getMessage());
        }
    }
}
