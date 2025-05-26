<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gidkom\OpenFireRestApi\OpenFireRestApi;

class ChatController extends Controller
{
    public function index()
    {
        $chatApi = new OpenFireRestApi();

        // Set the required config parameters
        $api->secret = env('XMPP_SECRET');
        $api->host = env('XMPP_HOST');
        $api->port = env('XMPP_PORT');  // default 9090

        // Optional parameters (showing default values)

        $api->useSSL = false;
        $api->plugin = "/plugins/restapi/v1";  // plugin

        // Get all groups
        try {
            $user =  $api->getUsers();
            return $api->getGroup();
        } catch (\Throwable $th) {
            return $th->error();
        }


    }
}
