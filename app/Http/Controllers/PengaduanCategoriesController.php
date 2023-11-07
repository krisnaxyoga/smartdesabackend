<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengaduanCategories;
use App\Desa;
use Illuminate\Support\Facades\Storage;

class PengaduanCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Data Kategori Pengaduan";
        if (isset($request->type) && $request->type == 'datatable') {
            $data = PengaduanCategories::orderBy('created_at','DESC')->get();
            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn  btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="' . route('categories.edit', $data->id) . '">Edit Kategori</a></li> <li><a data-id="' . $data->id . '" data-label="kategori" data-url="/pengaduan/categories/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return view('pengaduan.categories.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Tambah Kategori Pengaduan";
        return view('pengaduan.categories.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->file('photo') !== null) {
            $url = $this->uploadFileToS3($request);
        }  else {
            $url = null;
        }

        try {
            PengaduanCategories::create([
                'name' => $request->name,
                'photo' => $url
            ]);
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([$th->getMessage() . " at line " . $th->getLine()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = PengaduanCategories::find($id);
        $data['category'] = $category;
        $data['page_title'] = "Edit Data Kategori Pengaduan";
        return view('pengaduan.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $req = ['name' => $request->name];

            if ($request->file('photo') != null) {
                $url = $this->uploadFileToS3($request);
                $req['photo'] = $url;
            }

            PengaduanCategories::find($id)->update($req);
            return redirect()->route('categories.index');
        } catch (\Throwable $e) {
            DB::rollback();
            // return response()->json($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            PengaduanCategories::find($id)->delete();
            if ($request->ajax()) {
                return response()->json([
                    'error' =>false,
                    'message' => "Data Kategori successfully deleted."
                ]);
            }
            return redirect()->back()->with('success', 'Data Kategori successfully deleted.');
        } catch (\Exception $e) {

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Data Kategori failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Data Kategori failed to delete.');
        }
    }

    public function uploadFileToS3($request)
    {
                        //VALIDASI DATA YANG DIKIRIMKAN DARI FORM
    $this->validate($request, [
        'photo' => 'required|image|mimes:jpg,jpeg,png'
    ]);

    //JIKA FILE TERSEDIA
    if ($request->hasFile('photo')) {
        $file = $request->file('photo'); //MAKA KITA GET FILENYA
        //BUAT CUSTOM NAME YANG DIINGINKAN, DIMANA FORMATNYA KALI INI ADALH EMAIL + TIME DAN MENGGUNAKAN ORIGINAL EXTENSION
        $filename = $request->email . 'gls' . time() . '.' . $file->getClientOriginalExtension();
        //UPLOAD MENGGUNAKAN CONFIG S3, DENGAN FILE YANG DIMASUKKAN KE DALAM FOLDER IMAGES
        //SECARA OTOMATIS AMAZON AKAN MEMBUAT FOLDERNYA JIKA BELUM ADA
        $publicURI = "https://" . env('AWS_BUCKET') .".". env('AWS_URL') . "/pengaduan_category"."/" .$filename;
        Storage::disk('s3')->put('pengaduan_category/' . $filename, file_get_contents($file), 'public');
        //https://glsdesa.s3-ap-southeast-1.amazonaws.com/images/-1607082298.jpg
        //SIMPAN INFORMASI USER KE DATABASE
        //DAN profile YANG DISIMPAN HANYALAH FILENAME-NYA SAJA
        //REDIRECT KE HALAMAN YANG SAMA DAN BERIKAN NOTIFIKASI
        return $publicURI;
    }
    return redirect()->back()->with(['error' => 'Gambar Belum Dipilih']);

    }
}
