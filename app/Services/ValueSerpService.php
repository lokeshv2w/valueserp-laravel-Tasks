<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class ValueSerpService
{
    public function search($query)
    {
        $response = Http::get(config('services.valueserp.url'), [
            'api_key' => config('services.valueserp.key'),
            'q'       => $query,
            'gl'      => 'in',
            'hl'      => 'en',
        ]);

        if (!$response->successful()) {
            throw new Exception('ValueSERP API failed');
        }

        return $response->json();
    }
}