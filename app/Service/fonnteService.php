<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{

    protected $token;


    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }


    public function sendMessage($target, $message)
    {

        return Http::withHeaders([
            'Authorization' => $this->token
        ])->post('https://api.fonnte.com/send', [

                    'target' => $target,

                    'message' => $message,

                ]);

    }

}