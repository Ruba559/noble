<?php

namespace App\Http\Traits;
use App\Models\BackNotification;


trait HasDatabaseNotification 
{

    public function sendNotification($from_id , $to_id , $message , $payload) 
    {
      
        $backNotification = BackNotification::create([
            'from_id' => $from_id,
            'to_id' => $to_id,
            'message' => $message,
            'payload' => $payload,
        ]);

    }

}