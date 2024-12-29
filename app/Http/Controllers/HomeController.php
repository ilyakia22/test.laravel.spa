<?php

namespace App\Http\Controllers;

use App\Components\AmoClient;
use App\Models\Log;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //    $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // $log = new Log();
        // $log->comment = 'xxx';
        // $log->save();
        // // return response('error api', 400);
        // exit;
        $amoClient = new AmoClient();
        $leads = $amoClient->get('contacts/custom_fields');
        print_r($leads);
        //return view('home');
        exit;

        /*$amoContactData = [];
        $amoContactData['name'] = 'test777';
        $amoContactData['custom_fields_values'] = [
            [
                'field_id' => 737703,
                'values' => [
                    [
                        'value' => '+72445654633',
                        //'enum_id' => '1110791'
                        'enum_id' => 1110791
                    ]
                ]
            ],
            [
                'field_id' => 811073,
                'values' => [
                    [
                        'value' => 'comments77777',
                    ]
                ]
            ],
        ];
        // print_r($amoContactData);
        // exit;

        $amoClient = new AmoClient();
        $newClient = $amoClient->post('contacts', [$amoContactData]);
        $clientId = $newClient['_embedded']['contacts'][0]['id'];*/
        //43469475 
        try {
            $linkClient = new AmoClient();
            $linkClient = $linkClient->post('leads/30025051/link', [['to_entity_id' => 43469475, 'to_entity_type' => 'contacts', 'metadata' => ['is_main' => true]]]);
        } catch (\GuzzleHttp\Exception\RequestException $ex) {
            print_r($ex->getResponse()->getBody()->getContents());
            // you can even json_decode the response like json_decode($ex->getResponse()->getBody()->getContents(), true)    
        }


        print_r($linkClient);
    }
}
