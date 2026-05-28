<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BlingService
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = 'https://api.bling.com.br/Api/v3';

        $this->token = env('BLING_ACCESS_TOKEN');
    }

    // Buscar contato por CPF/CNPJ
    public function findContactByCpfCnpj($cpfCnpj)
    {
        $response = Http::withToken($this->token)
            ->get($this->baseUrl . '/contatos', [
                'numeroDocumento' => $cpfCnpj
            ]);

        return $response->json();
    }
}
