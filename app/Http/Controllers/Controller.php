<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){

        return view('notificationfcm');

    }
    public function sendNotification(){
        $token = "fSoLS71_Zk8:APA91bHBHLx6QyZIyd7BDt_vuhVTIhozKc_hckqEfxvlejJmewE8byUGwSEWska5UGe_pCqVvcjRDgy0Czm-76pXAAR-jvyqSy8I5LtCeRipTFeqh8oD5lWmNn61ywGpR4mU43ITleze";  
        $from = "AAAACqW2UT8:APA91bFxX1IRKMLr0vnuB52m6dvVqHfYVppPt7XpM4vxMxFcaW5NSiwhDgEKsgyv-_YUPjnMIVW3eRAe56IHVT_4MKI6cJ-gL1SY8bilUukU8_5PyrzAR3HRtcHdySPWmsvZAmtPHK_D";
        $msg = array
              (
                'body'  => "Testing Testing",
                'title' => "Hi, From Hawaa",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        dd($result);
        curl_close( $ch );
         

    }
}
