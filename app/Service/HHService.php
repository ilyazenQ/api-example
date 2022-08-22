<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Integer;

class HHService
{
    public function getEmployerByText(string $text)
    {
        $response = Http::get('https://api.hh.ru/employers', [
            'text' => $text,
        ]);

        return $response->json();
    }

}
