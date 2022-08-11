<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CladdingResources;
use App\Models\Cladding;

class CladdingController extends Controller
{
   
    public function index()
    {

        $cladding = Cladding::get();

        return  CladdingResources::collection($cladding);
     
    }

    
    public function store(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required',
        ]);
      
        $cladding = Cladding::create([
            'name' => $request->name,
            
        ]);

       
        return response($cladding, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'name' => 'required',
        ]);

        $cladding = Cladding::find($id); 

        $cladding->update([
            'name' => $request->name,
            
        ]);

        return response($cladding, 201);
    }

   
    public function destroy($id)
    {

        $cladding = Cladding::find($id); 

        $cladding->delete();

        return response($cladding, 201);
    }
}
