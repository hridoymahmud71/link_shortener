<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Utility\LinkGenerator;
use Illuminate\Support\Facades\Http;
use Str;

class LinkController extends Controller
{
    public function generate_link()
    {
        $request_data = request()->all();


        $validator_response  = $this->validator_response($request_data);
        $save_browsing_validator_response  = $this->validate_with_safe_browsing($request_data);

        if ($validator_response->getData()->result == false) {
            return $validator_response;
        }

        if ($save_browsing_validator_response->getData()->result == false) {
            return $save_browsing_validator_response;
        }

        try {
            $new_link =  LinkGenerator::generate_link($request_data['given_link']);
        } catch (\Exception $e) {

            return response()->json([
                'result'    => false,
                'message'   => "Link Generation Failed"
            ]);
        }

        return response()->json([
            'result'    => true,
            'message'   => "Link generated",
            'data'      => [
                'link' => $new_link
            ]
        ]);
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

        //Check if link is valid
        if (!filter_var($request_data['given_link'], FILTER_VALIDATE_URL)) {

            return response()->json([
                'result'    => false,
                'message'   => "Given link is not valid"
            ]);
        }

        // Passes !
        return response()->json([
            'result'    => true,
            'message'   => "Everything is ok"
        ]);
    }



    /*
        REQUEST POST , endpoint : https://safebrowsing.googleapis.com/v4/threatMatches:find?key={{api_key}}
        {
            "client": {
            "clientId":"yourcompanyname",
            "clientVersion":"1.5.2"
        },
        "threatInfo": {
            "threatTypes":["MALWARE", "SOCIAL_ENGINEERING","POTENTIALLY_HARMFUL_APPLICATION","UNWANTED_SOFTWARE"],
            "platformTypes":["ANY_PLATFORM"],
            "threatEntryTypes": ["URL"],
            "threatEntries":[
                    {
                    "url": "https://testsafebrowsing.appspot.com/s/phishing.html"
                    }
                ]
            }
        }
    */

    function validate_with_safe_browsing($request_data)
    {

        $post_data = [
            'client' => [
                'clientId' => 'yourcompanyname',
                'clientVersion' => '1.5.2',
            ],
            'threatInfo' => [
                'threatTypes' => [
                    0 => 'MALWARE',
                    1 => 'SOCIAL_ENGINEERING',
                    2 => 'POTENTIALLY_HARMFUL_APPLICATION',
                    3 => 'UNWANTED_SOFTWARE',
                ],
                'platformTypes' => [
                    0 => 'ANY_PLATFORM',
                ],
                'threatEntryTypes' => [
                    0 => 'URL',
                ],
                'threatEntries' => [
                    0 => [
                        'url' => $request_data['given_link'],
                    ],
                ],
            ],
        ];

        $check_url = "https://safebrowsing.googleapis.com/v4/threatMatches:find?key=" . env("GOOGLE_API_KEY");
        $response = Http::post(
            $check_url,
            $post_data
        );

        if (!$response->successful()) {
            return response()->json([
                'result'    => false,
                'message'   => "Unable to check the link via safebrowsing"
            ]);
        }

        /* output type
            {#297
                +"matches": array:1 [
                    0 => {#294
                    +"threatType": "MALWARE"
                    +"platformType": "ANY_PLATFORM"
                    +"threat": {#309
                        +"url": "https://testsafebrowsing.appspot.com/s/malware.html"
                    }
                    +"cacheDuration": "300s"
                    +"threatEntryType": "URL"
                    }
                ]
                }
        */

        // if the object is empty then the threat does not exists
        if ($response->object() != new \stdClass()) {

            return response()->json([
                'result'    => false,
                'message'   => "URL is threatful. Threat type : " . $response->object()->matches[0]->threatType
            ]);
        }


        // Passes !
        return response()->json([
            'result'    => true,
            'message'   => "Everything is ok"
        ]);
    }
}
