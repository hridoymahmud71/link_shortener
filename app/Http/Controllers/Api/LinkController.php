<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    public function generate_link()
    {
        $request_data = request()->all();


        $validator_response  = $this->validator_response($request_data);
        $validator_response  = $this->validator_response($request_data);

        if ($validator_response->getData()->result == false) {
            return $validator_response;
        }

        if ($validator_response->getData()->result == false) {
            return $validator_response;
        }
    }

    //validating the user request
    function validator_response($request_data)
    {
        //Check if link is empty
        if (empty($request_data['given_link'])) {
            return response()->json([
                'result'    => false,
                'message'   => "Link Cannot be empty"
            ]);
        }

        // Passes !
        return response()->json([
            'result'    => true,
            'message'   => "Everything is ok"
        ]);
    }

    function validate_with_safe_browsing()
    {
        // Passes !
        return response()->json([
            'result'    => true,
            'message'   => "Everything is ok"
        ]);
    }
}
