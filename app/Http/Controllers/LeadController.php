<?php

namespace App\Http\Controllers;

use App\Components\AmoClient;
use App\Http\Controllers\Controller;
use App\Http\Resources\LeadResource;

class LeadController extends Controller
{
	public function index()
	{
		$amoClient = new AmoClient();
		$params = [];
		$params['with'] = 'contacts';
		$params['order'] = [];
		$params['order']['updated_at'] = ['desc'];
		$responce = $amoClient->get('leads', $params);

		if (!isset($responce['_embedded']['leads'])) {
			return response('error get leads', 400);
		}
		return LeadResource::collection($responce['_embedded']['leads']);
	}
}
