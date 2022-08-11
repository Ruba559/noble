<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BackNotificationResources;
use App\Models\BackNotification;

class BackNotificationController extends Controller
{
   
    public function index()
    {

        $backNotification = BackNotification::get();

        return  BackNotificationResources::collection($backNotification);
     
    }


    public function store(Request $request)
    {

        $fields = $request->validate([
            'from_id' => 'required',
            'to_id' => 'required',
            'message' => 'required',
            'payload' => 'required',
        ]);

      
        $backNotification = BackNotification::create([
            'from_id' => $request->from_id,
            'to_id' => $request->to_id,
            'message' => $request->message,
            'payload' =>$request->payload,
            
        ]);

       
        return response($backNotification, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'from_id' => 'required',
            'to_id' => 'required',
            'message' => 'required',
            'payload' => 'required',
        ]);


        $backNotification = BackNotification::find($id); 

        $backNotification->update([
            'from_id' => $request->from_id,
            'to_id' => $request->to_id,
            'message' => $request->message,
            'payload' =>$request->payload,
        ]);

        return response($backNotification, 201);
    }

   
    public function destroy($id)
    {

        $backNotification = BackNotification::find($id); 

        $backNotification->delete();

        return response($backNotification, 201);
    }
}
