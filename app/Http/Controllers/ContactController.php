<?php

namespace App\Http\Controllers;

use App\Components\AmoClient;
use App\Http\Requests\ContactRequest;
use App\Models\Log;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(ContactRequest $contactRequest)
    {
        $data = $contactRequest->validated();
        $amoClient = new AmoClient();
        try {
            $amoContactData['name'] = $data['name'];
            $amoContactData['custom_fields_values'] = [
                [
                    'field_id' => 616071,
                    'values' => [
                        [
                            'value' => $data['phone'],
                            'enum_id' => 951257
                        ]
                    ]
                ],
                [
                    'field_id' => 617589,
                    'values' => [
                        [
                            'value' => $data['comment'],
                        ]
                    ]
                ],
            ];
            $newClient = $amoClient->post('contacts', [$amoContactData]);
            $clientId = $newClient['_embedded']['contacts'][0]['id'];
            Log::addOk('Клиент добавлен ' . $clientId);
        } catch (\GuzzleHttp\Exception\RequestException $ex) {
            Log::addError('Клиент не добавлен');
            print_r($ex->getResponse()->getBody()->getContents());
            return response('error api 1', 400);
        }

        try {
            $linkClient = $amoClient->post(
                'leads/' . $data['lead_id'] . '/link',
                [
                    [
                        'to_entity_id' => $clientId,
                        'to_entity_type' => 'contacts',
                        'metadata' => ['is_main' => true]
                    ]
                ]
            );
            Log::addOk('Клиент ' . $clientId . ' назначен к сделке ' . $data['lead_id']);
        } catch (\GuzzleHttp\Exception\RequestException $ex) {
            Log::addError('Ошибка назначения клиента к сделке');
            print_r($ex->getResponse()->getBody()->getContents());
            return response('error api 2', 400);
        }
        return $data;
    }
}
