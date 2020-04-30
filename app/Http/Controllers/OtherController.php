<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherController extends Controller
{


	public function about()
	{
		return view('main_view.about');
	}

	public function event()
	{
		return view('main_view.event');
	}
}
