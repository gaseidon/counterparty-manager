<?php
// app/Services/DaDataService.php
namespace App\Services;

use GuzzleHttp\Client;
use App\DTO\CounterpartyData;
use Illuminate\Support\Facades\Log;

class DaDataService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party/',
            'headers' => [
                'Authorization' => 'Token '.config('services.dadata.api_key'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
    }

    public function getCounterpartyData(string $inn): ?CounterpartyData
    {
        try {
            $response = $this->client->post('', [
                'json' => ['query' => $inn]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (empty($data['suggestions'])) {
                return null;
            }

            return new CounterpartyData(
                inn: $inn,
                name: $data['suggestions'][0]['data']['name']['short_with_opf'],
                ogrn: $data['suggestions'][0]['data']['ogrn'],
                address: $data['suggestions'][0]['data']['address']['unrestricted_value']
            );
        } catch (\Exception $e) {
            Log::error('DaData API error: '.$e->getMessage());
            return null;
        }
    }
}