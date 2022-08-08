<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResources;
use App\Models\Article;

class ArticleController extends Controller
{
    
    public function index()
    {

        $article = Article::get();

        return  ArticleResources::collection($article);
     
    }
}
