<?php

namespace App\Http\Controllers;

use App\DesaPamong;
use Auth, DB;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PamongController extends Controller
{
    /**
     * Controller construction.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Staff Pemerintahan Desa";
        if ($request->type == 'datatable') {
            $pamongs = DesaPamong::orderBy('pamong_nama', 'ASC')
                ->get();

            return datatables()->of($pamongs)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a target="_blank" href="' . route('pamong.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="pamong" data-url="/pamong/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })

                ->rawColumns(['action'])
                ->make(true);
        } else if ($request->type == 'json') {
            $pamongs = DesaPamong::orderBy('pamong_nama', 'ASC');

            if ($request->keyword) {
                $pamongs = $pamongs->where(
                    'pamong_nama',
                    'LIKE',
                    DB::raw('"%' . $request->keyword . '%"')
                );
            }

            $pamongs = $pamongs::get();

            return response()->json($pamongs);
        } else {
            return view('pamong.index', $data);
        }
    }

    /**
     * Create page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $data['page_title'] = "Tambah Staff Pemerintahan Desa";
        return view('pamong.create', $data);
    }

    /**
     * Edit page.
     *
     * @param  Request  $request
     * @param  String   $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $data = DesaPamong::find($id);
        return view('pamong.edit', [
            'data' => $data,
            'page_title' => "Edit Staff Pemerintahan Desa : {$data->pamong_nama}"
        ]);
    }

    /**
     * Store resource.
     *
     * @param  Request  $request
     * @param  String   $id
     * @return Response
     */
    public function store(Request $request)
    {
        $req = [
            'pamong_nama' => $request->pamong_nama,
            'pamong_nik' => $request->pamong_nik,
            'pamong_nip' => $request->pamong_nip,
            'jabatan' => $request->jabatan,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ];

        if ($request->file('profile') !== null) {
            $url = $this->uploadFileToS3($request);
            // dd($url);
            $req['foto'] = $url;
        }
        DesaPamong::create($req);

        if (isset($_POST['savenew'])) {
            return redirect()->back()->with('success', 'Staff Pemerintahan Desa successfully added.');
        } else {
            return redirect('pamong');
        }
    }

    /**
     * Store resource.
     *
     * @param  Request  $request
     * @param  String   $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $req = [
            'pamong_nama' => $request->pamong_nama,
            'pamong_nik' => $request->pamong_nik,
            'pamong_nip' => $request->pamong_nip,
            'jabatan' => $request->jabatan,
            'username' => $request->username
        ];
        if(isset($request->password)){
            $req['password'] = bcrypt($request->password);
        }
        if ($request->file('profile') !== null) {
            $url = $this->uploadFileToS3($request);
            // dd($url);
            $req['foto'] = $url;
        }
        DesaPamong::find($id)->update($req);

        return redirect('pamong')->with('success', 'Staff Pemerintahan Desa successfully updated.');
    }

    /**
     * Delete resource.
     *
     * @param  Request  $request
     * @param  String   $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            DesaPamong::find($id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Staff Pemerintahan Desa successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Staff Pemerintahan Desa successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Staff Pemerintahan Desa failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Staff Pemerintahan Desa failed to delete.');
        }
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
                $filename = $request->email . 'gls' . time() . '.' . $file->getClientOriginalExtension();
                //UPLOAD MENGGUNAKAN CONFIG S3, DENGAN FILE YANG DIMASUKKAN KE DALAM FOLDER IMAGES
                //SECARA OTOMATIS AMAZON AKAN MEMBUAT FOLDERNYA JIKA BELUM ADA
                $publicURI = "https://" . env('AWS_BUCKET') .".". env('AWS_URL') . "/kepdes"."/" .$filename;
                Storage::disk('s3')->put('kepdes/' . $filename, file_get_contents($file), 'public');
                //https://glsdesa.s3-ap-southeast-1.amazonaws.com/images/-1607082298.jpg
                //SIMPAN INFORMASI USER KE DATABASE
                //DAN profile YANG DISIMPAN HANYALAH FILENAME-NYA SAJA
                //REDIRECT KE HALAMAN YANG SAMA DAN BERIKAN NOTIFIKASI
                return $publicURI;
            }
            return redirect()->back()->with(['error' => 'Gambar Belum Dipilih']);
    }
}
