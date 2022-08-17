<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResources;
use App\Models\Article;
use App\Jobs\UploadImage;

class ArticleController extends Controller
{
    
    public function index()
    {

        $article = Article::get();

        return  ArticleResources::collection($article);
     
    }


    public function store(Request $request)
    {

        $fields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
            'author_id' => 'required',
            'seo_title' => 'required',
            'seo_description' => 'required',
            'image' => 'nullable',
        ]);
        $imageName = "";

        if($request->image){
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            //$image->move(public_path('images\articles'),$imageName);
        
            UploadImage::dispatch($request->image);
       
        }

        $article = Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'author_id' => $request->author_id,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'image' => $imageName,
        ]);

       
        return response($article, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
            'author_id' => 'required',
            'seo_title' => 'required',
            'seo_description' => 'required',
            'image' => 'required',
        ]);
        $article = Article::find($id); 
       
        $article->update($request->except(['image']));

        if ($request->image) {
            if($article->image)
            {
            if(File_exists(public_path('images/articles'.'/'.$article->image))){

                unlink(public_path('images/articles'.'/'.$article->image));
            }

                $image = $request->file('image');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('images\articles'),$imageName);
        
                $article->update(['image' => $imageName]);
        }else{
            
            $image= $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images\articles'),$imageName);
    
            $article->update(['image' => $imageName]);
        }
        }

        return response($article, 201);
    }

   
    public function destroy($id)
    {

        $article = Article::find($id); 

        if(File_exists(public_path('images/articles'.'/'.$article->image))){

            unlink(public_path('images/articles').'/'.$article->image);
        }

        $article->delete();

        return response($article, 201);
    }

}
