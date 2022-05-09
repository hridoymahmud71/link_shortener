<?php
namespace App\Utility;

use App\Models\Link;
use Str;
class LinkGenerator
{

    public static function generate_link($given_link){

        $slug = strtolower(Str::random(6));

        //create a slug unless it is unique
        while(Link::where("slug",$slug)->count() > 0){
            $slug = strtolower(Str::random(6));
        }

        $new_link = new Link;
        $new_link->slug = $slug;
        $new_link->original = $given_link;
        $new_link->save();

        return url("/$new_link->slug"); 

    }

}
