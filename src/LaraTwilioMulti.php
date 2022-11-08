<?php

namespace Armenium\LaraTwilioMulti;

use Twilio\Rest\Client;

class LaraTwilioMulti
{
    /** @var Twilio\Rest\Client */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function notify(string $number, string $message)
    {
        return $this->client->messages->create($number, [
            'from' => config('laratwiliomulti.sms_from'),
            'body' => $message,
        ]);
    }
}
