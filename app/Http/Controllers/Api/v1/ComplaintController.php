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
}
