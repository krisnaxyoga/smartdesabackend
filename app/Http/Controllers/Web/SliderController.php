<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use DB,Auth;
use Illuminate\Support\Facades\Storage;
class SliderController extends Controller
{
    /**
     * Controller construction.
    */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Slider";
        if ($request->type == 'datatable') {
            $dataContent = Slider::select('*')
                ->orderBy('title', 'ASC')
                ->get();

            return datatables()->of($dataContent)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="' . route('slider.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="home-slider" data-url="/slider/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->addColumn('tgl_dibuat', function ($data) {
                    return date('d F Y',strtotime($data->created_at));
                })

                ->rawColumns(['action','slider'])
                ->make(true);
        } else if ($request->type == 'json') {
            $dataContent = Slider::select('*')
                ->orderBy('title', 'ASC');

            if ($request->keyword) {
                $dataContent = $dataContent->where(
                    'title',
                    'LIKE',
                    DB::raw('"%' . $request->keyword . '%"')
                );
            }

            $dataContent = $dataContent::get();

            return response()->json($dataContent);
        } else {
            return view('web_front.slider.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web_front.slider.create',[
            'page_title' => "Tambah Berita"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = [
            'desa_id' => Auth::user()->desa_id,
            'title' => $request->title,
        ];

        if ($request->file('profile') !== null) {
            $url = $this->uploadFileToS3($request);
            // dd($url);
            $req['gambar'] = $url;
        }

        DB::beginTransaction();
        try {
            Slider::create($req);
            DB::commit();

            return redirect()->route('slider.index');
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());

        } catch(\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());

        }

        return response()->json($req);
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
        $data = Slider::find($id);
        return view('web_front.slider.edit',[
            'data' => $data,
            'page_title' => "Tambah Berita"
        ]);
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
        //
        $data = Slider::find($id);
        $req = [
            'title' => $request->title,
        ];

        if ($request->file('profile') !== null) {
            $url = $this->uploadFileToS3($request);
            // dd($url);
            $req['gambar'] = $url;
        }

        DB::beginTransaction();
        try {
            Slider::find($id)->update($req);
            DB::commit();

            return redirect()->route('slider.index');
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());

        } catch(\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Slider::find($id);

        if ($data == null) {
            abort(404);
        }

        $data->delete();

        return response()->json([
            'error' => false,
            'message' => 'Area berhasil dihapus.'
        ]);
    }
    public function uploadFileToS3($request)
    {
            //VALIDASI DATA YANG DIKIRIMKAN DARI FORM
    $this->validate($request, [
        'profile' => 'required|image|mimes:jpg,jpeg,png'
    ]);

    //JIKA FILE TERSEDIA
    if ($request->hasFile('profile')) {
        $file = $request->file('profile'); //MAKA KITA GET FILENYA
        //BUAT CUSTOM NAME YANG DIINGINKAN, DIMANA FORMATNYA KALI INI ADALH EMAIL + TIME DAN MENGGUNAKAN ORIGINAL EXTENSION
        $filename = $request->email . '-' . time() . '.' . $file->getClientOriginalExtension();
        //UPLOAD MENGGUNAKAN CONFIG S3, DENGAN FILE YANG DIMASUKKAN KE DALAM FOLDER IMAGES
        //SECARA OTOMATIS AMAZON AKAN MEMBUAT FOLDERNYA JIKA BELUM ADA
        $publicURI = "https://" . env('AWS_BUCKET') .".". env('AWS_URL') . "/slider"."/" .$filename;
        Storage::disk('s3')->put('slider/' . $filename, file_get_contents($file), 'public');
        //https://glsdesa.s3-ap-southeast-1.amazonaws.com/images/-1607082298.jpg
        //SIMPAN INFORMASI USER KE DATABASE
        //DAN profile YANG DISIMPAN HANYALAH FILENAME-NYA SAJA
        //REDIRECT KE HALAMAN YANG SAMA DAN BERIKAN NOTIFIKASI
        return $publicURI;
    }
    return redirect()->back()->with(['error' => 'Gambar Belum Dipilih']);   }
}
