<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
use App\KepalaDusun;

class BaseApiController extends Controller 
{
    public function getUser($id)
    {
        return KepalaDusun::where('api_key',$id)->first();
    }

    public function errorResponseObj($e)
    {
        return response()->json([
            'error' => true,
            'message' => "Error : " . $e->getMessage() . " at line " . $e->getLine(),
            'data' => null
        ]);
    }

    public function errorResponse($e)
    {
        return response()->json([
            'error' => true,
            'message' => "Error : " . $e ,
            'data' => null
        ]);
    }

    public function notFoundResponse()
    {
        return response()->json([
            'error' => true,
            'message' => 'Data not Found',
            'data' => null
        ]);
    }


    public function errorValidationResponse()
    {
        return response()->json([
            'error' => true,
            'message' => "Check Form Data",
            'data' => null
        ]);
    }

    public function errorMessageResponse($message)
    {
        return response()->json([
            'error' => true,
            'message' => $message,
            'data' => null
        ]);
    }

    public function successResponse($result)
    {
        return response()->json([
            'error' => false,
            'message' => 'Success',
            'data' => $result
        ]);
    }
    
    public function successResponseNoData()
    {
        return response()->json([
            'error' => false,
            'message' => 'Success'
        ]);
    }
    public function successDeleteResponse()
    {
        return response()->json([
            'error' => false,
            'message' => 'Data Deleted Successfull',
            'data' => null
        ]);
    }

    public function getValidationErrorMessage($validation)
    {
        $errors = $validation->errors();
        $errors =  json_decode($errors->toJson(),1);
        $errMsg = [];
        foreach ($errors as $key => $value) {
            $errMsg[] = $value[0];
        }

        return implode(", ",$errMsg);
    }

}
