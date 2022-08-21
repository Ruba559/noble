<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\OfficeResources;
use App\Models\Office;

class OfficeController extends Controller
{

    public function index()
    {

        $office = Office::get();

        return  OfficeResources::collection($office);
     
    }


    public function store(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required',
            'logo' => 'required',
            'cover' => 'required',
            'mobile_number' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'description' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            'url' => 'nullable'
        ]);

      

        $office = Office::create([
            'name' => $request->name,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'city_id' => $request->city_id,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => $request->user_id,
            'slug' => $this->slug($request->name),
            'logo' => $imageNameLogo,
            'cover' => $imageNameCover,
            'url' => $request->url
        ]);

       
        return response($office, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'name' => 'required',
            'logo' => 'nullable',
            'cover' => 'nullable',
            'mobile_number' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'description' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            'url' => 'nullable'
        ]);

        $office = Office::find($id); 
       
        $office->update($request->except(['cover' , 'logo']));

        if ($request->logo) {
            if($office->logo)
            {
            if(File_exists(public_path('images/office/logo'.'/'.$office->logo))){

                unlink(public_path('images/office/logo'.'/'.$office->logo));
            }

                $image = $request->file('logo');
                $imageNameLogo = time().'.'.$image->extension();
                $image->move(public_path('images\office\logo'),$imageNameLogo);
        
                $office->update(['logo' => $imageNameLogo]);
        }else{
            
            $image= $request->file('logo');
            $imageNameLogo = time().'.'.$image->extension();
            $image->move(public_path('images\office\logo'),$imageNameLogo);
    
            $office->update(['logo' => $imageNameLogo]);
        }
        }

        if ($request->cover) {
            if($office->cover)
            {
            if(File_exists(public_path('images/office/cover'.'/'.$office->cover))){

                unlink(public_path('images/office/cover'.'/'.$office->cover));
            }

                $image = $request->file('cover');
                $imageNameCover = time().'.'.$image->extension();
                $image->move(public_path('images\office\cover'),$imageNameCover);
        
                $office->update(['cover' => $imageNameCover]);
        }else{
            
            $image= $request->file('cover');
            $imageNameCover = time().'.'.$image->extension();
            $image->move(public_path('images\office\cover'),$imageNameCover);
    
            $office->update(['cover' => $imageNameCover]);
        }
        }

        return response($office, 201);
    }

   
    public function destroy($id)
    {

        $office = Office::find($id); 

        if(File_exists(public_path('images/office/logo'.'/'.$office->logo))){

            unlink(public_path('images/office/logo').'/'.$office->logo);
        }
        if(File_exists(public_path('images/office/cover'.'/'.$office->cover))){

            unlink(public_path('images/office/cover').'/'.$office->cover);
        }


        $office->delete();

        return response($office, 201);
    }


    public function slug($string, $separator = '-')
    {
        if (is_null($string)) {
            return "";
        }
    
        $string = trim($string);
        $string = mb_strtolower($string, "UTF-8");;
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", $separator, $string);
    
        return $string;
    }
}
