<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LinkController extends Controller
{

    public function show_link_generator()
    {
        return view('frontend.app');
    }
}
