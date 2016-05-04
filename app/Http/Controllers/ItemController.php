<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function itemLookup(Request $request)
    {
        $itemId = $request->input('ItemId');
        // Your AWS Access Key ID, as taken from the AWS Your Account page
        $aws_access_key_id = "AKIAIYMYHFPMXK4RY32A";

        // Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
        $aws_secret_key = "nRajx6SahJDAYeY45tEFuTcrtNgTnfECYx8rnqu8";

        // The region you are interested in
        $endpoint = "webservices.amazon.com";

        $uri = "/onca/xml";

        $params = array(
            "Service" => "AWSECommerceService",
            "Operation" => "ItemLookup",
            "AWSAccessKeyId" => "AKIAIYMYHFPMXK4RY32A",
            "AssociateTag" => "techcliks-20",
            "ItemId" => $itemId,
            "IdType" => "ASIN",
            "ResponseGroup" => "Images,ItemAttributes,Offers"
        );

        // Set current timestamp if not set
        if (!isset($params["Timestamp"])) {
            $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
        }

        // Sort the parameters by key
        ksort($params);

        $pairs = array();

        foreach ($params as $key => $value) {
            array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
        }

        // Generate the canonical query
        $canonical_query_string = join("&", $pairs);

        // Generate the string to be signed
        $string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;

        // Generate the signature required by the Product Advertising API
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));

        // Generate the signed URL
        $request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

        // echo "$request_url";

        $response = file_get_contents($request_url);
        $parsed_xml = simplexml_load_string($response);
        // echo $response;

        // //Verify a successful request
        // foreach($parsed_xml->OperationRequest->Errors->Error as $error){
        //    echo "Error code: " . $error->Code . "\r\n";
        //    echo $error->Message . "\r\n";
        //    echo "\r\n";
        // }

        // print_r($parsed_xml);
        // var_dump(gettype($parsed_xml->Items->Item->ImageSets->ImageSet));
        $itemInfo = array(
          'title' => (string)$parsed_xml->Items->Item->ItemAttributes->Title,
          'brand' => (string)$parsed_xml->Items->Item->ItemAttributes->Brand,
          'amount' => (string)$parsed_xml->Items->Item->ItemAttributes->ListPrice->Amount,
          'formattedPrice' => (string)$parsed_xml->Items->Item->ItemAttributes->ListPrice->FormattedPrice,
          'feature' => $parsed_xml->Items->Item->ItemAttributes->Feature,
          'url' => (string)$parsed_xml->Items->Item->DetailPageURL,
          'images' => $parsed_xml->Items->Item->ImageSets->ImageSet
        );
        $res = json_encode($parsed_xml);
        return $res;
    }
}