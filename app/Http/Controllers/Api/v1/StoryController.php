<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\StoryResources;
use App\Models\Story;

class StoryController extends Controller
{

    public function index()
    {

        $story = Story::get();

        return  StoryResources::collection($story);
     
    }


    public function store(Request $request)
    {

        $fields = $request->validate([
            'title' => 'required',
            'property_id' => 'required',
            'office_id' => 'required',
            'image' => 'required',
        ]);
        $imageName = "";

        if($request->image){

        $image= $request->file('image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images\story'),$imageName);
        }

        $story = Story::create([
            'title' => $request->title,
            'property_id' => $request->property_id,
            'office_id' => $request->office_id,
            'image' => $imageName,
        ]);

       
        return response($story, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'title' => 'required',
            'property_id' => 'required',
            'office_id' => 'required',
            'image' => 'required',
        ]);
        $story = Story::find($id); 
       
        $story->update($request->except(['image']));

        if ($request->image) {
            if($story->image)
            {
            if(File_exists(public_path('images/story'.'/'.$story->image))){

                unlink(public_path('images/story'.'/'.$story->image));
            }

                $image = $request->file('image');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('images\story'),$imageName);
        
                $story->update(['image' => $imageName]);
        }else{
            
            $image= $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images\story'),$imageName);
    
            $story->update(['image' => $imageName]);
        }
        }

        return response($story, 201);
    }

   
    public function destroy($id)
    {

        $story = Story::find($id); 

        if(File_exists(public_path('images/story'.'/'.$story->image))){

            unlink(public_path('images/story').'/'.$story->image);
        }

        $story->delete();

        return response($story, 201);
    }
}
