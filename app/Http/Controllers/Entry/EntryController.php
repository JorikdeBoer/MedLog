<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Symptom;
use App\Illness;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class EntryController extends Controller
{
	// public function home ()
	// {
	// 	return view ('entries/create_entry');
	// }

	public function create()
	{
    	$symptomes = Symptom::all();
    	$illnesses = Illness::all();
        return view('entries/create_entry', compact('symptomes', 'illnesses'));
	}

	public function store (Request $request) 
	{
		$request->validate([
            'name'  => 'required',
        ]);
	}
}