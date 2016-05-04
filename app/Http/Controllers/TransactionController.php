<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use PayWithAmazon\Client;

class TransactionController extends Controller
{
    var $config = array('merchant_id'   => 'A3U4WD211IW75F',
                'access_key'    => 'AKIAI7WJBK4DCIEJSQHA',
                'secret_key'    => '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',
                'client_id'     => 'amzn1.application-oa2-client.2950611bb1f048b9861c7c230dd2b142',
                'region'        => 'us',
                'currency_Code' => 'USD',
                'sandbox'       => true);

    // var $config = array('merchant_id'   => 'A3U4WD211IW75F',
    //             'access_key'    => 'AKIAIYMYHFPMXK4RY32A',
    //             'secret_key'    => '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',
    //             'client_id'     => 'amzn1.application-oa2-client.2950611bb1f048b9861c7c230dd2b142',
    //             'region'        => 'us',
    //             'currency_Code' => 'USD',
    //             'sandbox'       => true);
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDetails(Request $request)
    {

        // Instantiate the client object with the configuration
        $client = new Client($this->config);
        $requestParameters = array();
        $amount = $request->input('amount');
        $orderReferenceId = $request->input('orderReferenceId');
        // Create the parameters array to set the order
        $requestParameters['amount']            = $amount;
        $requestParameters['currency_code']     = 'USD';
        $requestParameters['seller_note']       = 'This is testing API call';
        $requestParameters['seller_order_id']   = '123456-TestOrder-123456';
        $requestParameters['store_name']        = 'Saurons collectibles in Mordor';
        $requestParameters['seller_Id']         = null;
        $requestParameters['seller_order_id']   = '1234-example-order';
        $requestParameters['platform_id']       = null;
        $requestParameters['custom_information']= 'any custom information';
        $requestParameters['mws_auth_token']    = null;
        $requestParameters['amazon_order_reference_id'] = $orderReferenceId;

        // Set the Order details by making the SetOrderReferenceDetails API call
        $res = $client->setOrderReferenceDetails($requestParameters);

        // If the API call was a success Get the Order Details by making the GetOrderReferenceDetails API call
        if($client->success)
        {
            $requestParameters['address_consent_token']    = null;
            $res = $client->getOrderReferenceDetails($requestParameters);
        }
        // Adding the Order Reference ID to the session so that we can use it in ConfirmAndAuthorize.php
        // $_SESSION['amazon_order_reference_id'] = $orderReferenceId;
        $request->session()->put('amount', $amount);
        $request->session()->put('amazon_order_reference_id', $orderReferenceId);

        // Pretty print the Json and then echo it for the Ajax success to take in
        $json = json_decode($res->toJson());
        echo json_encode($json, JSON_PRETTY_PRINT);

    }

    public function authorizeAndCapture(Request $request)
    {

        // Instantiate the client object with the configuration
        $client = new Client($this->config);
        $amount = $request->session()->get('amount', '0');
        // Create the parameters array to set the order
        $requestParameters = array();
        $requestParameters['amazon_order_reference_id'] = $request->session()->get('amazon_order_reference_id', null);
        $requestParameters['mws_auth_token'] = null;

        // Confirm the order by making the ConfirmOrderReference API call
        $response = $client->confirmOrderReference($requestParameters);

        $responsearray['confirm'] = json_decode($response->toJson());

        // If the API call was a success make the Authorize (with Capture) API call
        if($client->success)
        {
            $requestParameters['authorization_amount'] = $amount;
            $requestParameters['authorization_reference_id'] = uniqid('A01_REF_');
            $requestParameters['seller_Authorization_Note'] = 'Authorizing and capturing the payment';
            $requestParameters['transaction_timeout'] = 0;
            
            // For physical goods the capture_now is recommended to be set to false. The capture_now can be set to true if the order was a digital good
            $requestParameters['capture_now'] = true;
            $requestParameters['soft_descriptor'] = null;

            $response = $client->authorize($requestParameters);
            $responsearray['authorize'] = json_decode($response->toJson());
        }

        // // If the Authorize API call was a success, make the Capture API call when you are ready to capture for the order (for example when the order has been dispatched)
        // if($client->success)
        // {
        //     $requestParameters['amazon_authorization_id'] = 'Parse the Authorize Response for this id';
        //     $requestParameters['capture_amount'] = '19.95';
        //     $requestParameters['currency_code'] = 'USD';
        //     $requestParameters['capture_reference_id'] = 'Your Unique Reference Id';

        //     $response = $client->capture($requestParameters);
        //     $responsearray['capture'] = json_decode($response->toJson());
        // }

        // Echo the Json encoded array for the Ajax success
        echo json_encode($responsearray);
    }
}