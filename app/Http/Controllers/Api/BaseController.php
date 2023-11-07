<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth, DB;

use App\Category;

class BaseController extends Controller
{
   
    public function category()
    {
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 999;
        $data = Category::orderBy('name', 'ASC')->limit($limit)->get();
        return response()->json($data);
    }

}
