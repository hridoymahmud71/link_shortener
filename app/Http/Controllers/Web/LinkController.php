<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Redirect;

class LinkController extends Controller
{

    public function go_to_link($slug)
    {
        $existing_link = Link::where("slug", $slug)->first();

        if ($existing_link == null) {
            abort(404);
        }

        return Redirect::to($existing_link->original);
    }

    public function show_link_generator()
    {
        return view('frontend.app');
    }
}
