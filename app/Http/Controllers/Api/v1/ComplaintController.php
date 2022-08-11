<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ComplaintResources;
use App\Models\Complaint;

class ComplaintController extends Controller
{

    public function index()
    {

        $complaint = Complaint::get();

        return  ComplaintResources::collection($complaint);
     
    }


    public function store(Request $request)
    {

        $fields = $request->validate([
            'user_id' => 'required',
            'type' => 'required',
            'description' => 'required',
            'reply_message' => 'required',
            'replier_id' => 'required',
            
        ]);

      
        $complaint = Complaint::create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'description' => $request->description,
            'reply_message' => $request->reply_message,
            'replier_id' => $request->replier_id,
            
        ]);

       
        return response($complaint, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'user_id' => 'required',
            'type' => 'required',
            'description' => 'required',
            'reply_message' => 'required',
            'replier_id' => 'required',
            
        ]);

        $complaint = Complaint::find($id); 

        $complaint->update([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'description' => $request->description,
            'reply_message' => $request->request,
            'replier_id' => $request->replier_id
        ]);

        return response($complaint, 201);
    }

   
    public function destroy($id)
    {

        $complaint = Cladding::find($id); 

        $complaint->delete();

        return response($complaint, 201);
    }
}
