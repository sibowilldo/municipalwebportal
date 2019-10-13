<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class FCMNotification extends Model
{
    public function sendToDevice($token, $title, $body)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();

        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        // return Array - you must remove all this tokens in your database
        $tokensToDelete = $downstreamResponse->tokensToDelete();

        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $tokensToModify = $downstreamResponse->tokensToModify();

        // return Array - you should try to resend the message to the tokens in the array
        $tokensToRetry = $downstreamResponse->tokensToRetry();

        // return Array (key:token, value:error) - in production you should remove from your database the tokens
        $tokensWithError = $downstreamResponse->tokensWithError();

        return response()->json(['data'=>[
                'message'       => 'Process Completed!',
                'delete_tokens' => $tokensToDelete,
                'modify_tokens' => $tokensToModify,
                'retry_tokens'  => $tokensToRetry,
                'error_tokens'  => $tokensWithError
            ]
        ], 200);
    }
}
