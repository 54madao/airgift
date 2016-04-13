<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function login(Request $request)
    {
        echo $request;
        //$token = $request->input('access_token');
        //echo $token;
        // verify that the access token belongs to us
        $c = curl_init('https://api.amazon.com/auth/o2/tokeninfo?access_token=' . urlencode($_REQUEST['access_token']));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
         
        $r = curl_exec($c);
        curl_close($c);
        $d = json_decode($r);
         
        if ($d->aud != 'amzn1.application.4db3b6c0559b401ba16cd3e9aa9e2ffc') {
          // the access token does not belong to us
          header('HTTP/1.1 404 Not Found');
          echo 'Page not found';
          exit;
        }
         
        // exchange the access token for user profile
        $c = curl_init('https://api.amazon.com/user/profile');
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Authorization: bearer ' . $_REQUEST['access_token']));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
         
        $r = curl_exec($c);
        curl_close($c);
        $d = json_decode($r);
         
        echo sprintf('%s %s %s', $d->name, $d->email, $d->user_id);
    }
}