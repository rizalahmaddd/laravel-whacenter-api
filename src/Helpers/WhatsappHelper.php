<?php

namespace Rizalahmaddd\WhatsappApi\Helpers;

use Illuminate\Support\Facades\Http;

class WhatsappHelper
{
    protected $deviceId;
    protected $apiUrl;

    public function __construct()
    {
        $this->deviceId = config('whatsapp.device_id');
        $this->apiUrl = config('whatsapp.api_url');
    }

    public function sendMessage($number, $message, $file = null)
    {
        $formattedNumber = $this->parsePhoneNumber($number);
        if (!$formattedNumber) {
            return ['error' => 'Nomor telepon tidak valid'];
        }

        $payload = [
            'device_id' => $this->deviceId,
            'number'    => $formattedNumber,
            'message'   => $message,
        ];

        if ($file) {
            $payload['file'] = $file;
        }

        $response = Http::post($this->apiUrl, $payload);
        return $response->json();
    }

    private function parsePhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace('/\s+/', '', $phoneNumber);

        if (strpos($phoneNumber, '+62') === 0) {
            $phoneNumber = substr($phoneNumber, 1);
        } elseif (strpos($phoneNumber, '0') === 0) {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        } elseif (strpos($phoneNumber, '8') === 0) {
            $phoneNumber = '62' . $phoneNumber;
        }

        return strpos($phoneNumber, '62') === 0 ? $phoneNumber : null;
    }
}
