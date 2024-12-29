<?php

namespace App\Components;

use GuzzleHttp\Client;

use function PHPUnit\Framework\throwException;

class AmoClient
{

	public $client;

	private $fileTokens = '../storage/tokens.json';

	public function __construct()
	{

		$this->client = new Client([
			'base_uri' => 'https://' . env('AMO_SUBDOMAIN') . '.amocrm.ru/api/v4/',
			'headers' => [
				'Authorization' => 'Bearer ' . $this->getAccessToken(),
				'Content-Type' => 'application/json',
			],
		]);
	}

	private function getAccessToken()
	{
		$tokenData = json_decode(file_get_contents($this->fileTokens), true);

		if (time() + 60 >= $tokenData['end_token_time']) {
			$tokenUrl = 'https://' . env('AMO_SUBDOMAIN') . '.amocrm.ru/oauth2/access_token';

			$data = [
				'client_id' => env('AMO_CLIENT_ID'),
				'client_secret' => env('AMO_CLIENT_SECRET'),
				'refresh_token' => $tokenData['refresh_token'],
				'redirect_uri' => env('AMO_REDIRECT_URI'),
				'grant_type' => 'refresh_token'
			];

			$headers = [];
			$headers['Content-Type'] = 'application/json';
			$guzzle = new Client(['headers' => $headers]);

			$response = $guzzle->post($tokenUrl, ['json' => $data]);

			$json = $response->getBody();
			$dataResponse = json_decode($json, true);
			if (isset($dataResponse['access_token'])) {
				$dataResponse['end_token_time'] = time() +  $dataResponse['expires_in'];
				file_put_contents($this->fileTokens, json_encode($dataResponse));
				return $dataResponse['access_token'];
			}
			return false;
		} else {
			return $tokenData['access_token'];
		}
	}

	public function get(string $endpoint, array $params = [])
	{
		$add = '';
		if (count($params) > 0) $add = '?' . http_build_query($params);
		$response = $this->client->request('GET', $endpoint . $add);
		return json_decode($response->getBody()->getContents(), true);
	}

	public function post(string $endpoint, array $data)
	{
		$response = $this->client->request('POST', $endpoint, [
			'json' => $data,
		]);
		return json_decode($response->getBody()->getContents(), true);
	}
}
