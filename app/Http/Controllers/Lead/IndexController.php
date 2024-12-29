<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	public function __invoke()
	{
		$leads = [
			[
				'id' => '1',
				'name' => 'name1',
				'date' => 'date1',
				'is_exists_contact' => true

			],
			[
				'id' => '2',
				'name' => 'name2',
				'date' => 'date2',
				'is_exists_contact' => true

			],
			[
				'id' => '3',
				'name' => 'name3',
				'date' => 'date3',
				'is_exists_contact' => false

			]
		];
		return $leads;
	}
}
