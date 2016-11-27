<?php

namespace CDG\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;


class ModulesController extends Controller
{
    public function create()
    {
        return view('modules.contact');
    }

    public function store()
    {

        return redirect()->route('contact')->with('message', 'Thanks for contacting us!');

    }
}
