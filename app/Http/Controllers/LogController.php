<?php

namespace App\Http\Controllers;

use App\Components\AmoClient;
use App\Http\Controllers\Controller;
use App\Http\Resources\LogResource;
use App\Models\Log;

class LogController extends Controller
{
	public function index()
	{
		$logs = Log::all();
		return LogResource::collection($logs);
	}
}
