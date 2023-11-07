<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Desa;

class FileController extends Controller
{
    //
    public function store(Request $request)
    {
        $desa_id = $request->header("DesaId");

        $desa = Desa::where('id',$desa_id)->first();

        if($desa) {
            $image = $request->file('file');

            // Generate streamed file.
    
            $imageFileName = md5(time()) . md5($image->getClientOriginalName());
            // $image = Image::make($request->file('logo'))->resize(300, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->stream();
            // dd((string)$image);
            $s3 = \Storage::disk('s3');

            $imageFileName = $s3->putFile($desa->kode_desa, $image, "public");
                
            $publicURI = "https://" . env('AWS_URL') . "/" . env('AWS_BUCKET') . "/" . $imageFileName;
            return response()->json([
                'error' => false,
                'data' => $publicURI
            ]);

        } else {
            return response()->json([
                'error' => true,
                'data' => "Desa Tidak Ditemukan"
            ]);
        }

        
    }
}
