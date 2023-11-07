<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Notification as LogNotification;
use App\Utils\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Data Pengumuman";
        if (isset($request->type) && $request->type == 'datatable') {
            $dataNotification = LogNotification::where('type','ANNOUNCEMENT')->orderBy('created_at', 'DESC')->get();
            return datatables()->of($dataNotification)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn  btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"> <li><a data-id="' . $data->id . '" data-label="pengumuman" data-url="/notification-resend/' . $data->id . '" class="resend-item">Kirim Ulang</a></li> <li><a href="' . route('notification.edit', $data->id) . '">Edit Pengumuman</a></li> <li><a data-id="' . $data->id . '" data-label="pengumuman" data-url="/notification/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return view('notification.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Tambah Pengumuman";
        return view('notification.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id_desa = auth()->user()->desa_id;
        $desa = Desa::find($id_desa);
        try {

            if (env("APP_ENV") == "local") {
                Notification::send([
                    'title' => $request->title,
                    'body' => $request->description,
                    'to' => "/topics/dev_" . $desa->kode_desa,
                    'click_action' => ""
                ]);
            } else {
                Notification::send([
                    'title' => $request->title,
                    'body' => $request->description,
                    'to' => "/topics/prod_" . $desa->kode_desa,
                    'click_action' => ""
                ]);
            }

            if ($request->file('photo') !== null) {
                $urlImg = $this->uploadFileToS3($request);
            } else {
                $urlImg = null;
            }

            LogNotification::create([
                'title' => $request->title,
                'type' => "ANNOUNCEMENT",
                'description' => $request->description,
                'photo' => $urlImg
            ]);

            return redirect()->route('notification.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([$th->getMessage() . " at line " . $th->getLine()]);
        }
    }

    public function resend(Request $request, $id)
    {
        $notif = LogNotification::find($id);
        $desa = Desa::find($notif->desa_id);
        try {

            if (env("APP_ENV") == "local") {
                Notification::send([
                    'title' => $notif->title,
                    'body' => $notif->description,
                    'to' => "/topics/dev_" . $desa->kode_desa,
                    'click_action' => ""
                ]);
            } else {
                Notification::send([
                    'title' => $notif->title,
                    'body' => $notif->description,
                    'to' => "/topics/prod_" . $desa->kode_desa,
                    'click_action' => ""
                ]);
            }
            if ($request->ajax()) {
                return response()->json([
                    'error' =>false,
                    'message' => "Data Pengumuman successfully resend."
                ]);
            }
            return redirect()->back()->with('success', 'Data Pengumuman successfully resend.');

        } catch (\Throwable $th) {

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Data Pengumuman failed to resend.'
                ]);
            }
            return redirect()->back()->with('error', 'Data Pengumuman failed to resend.');
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
        $notif = LogNotification::find($id);
        $data['notif'] = $notif;
        $data['page_title'] = "Edit Data Pengumuman";
        return view('notification.edit', $data);
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
        $data = LogNotification::find($id);

        if (!$data) {
            abort(404);
        }

        try {
            $data = new LogNotification();
            $fillable = $data->getFillable();
            $values = $request->only($fillable);
            $data = LogNotification::where('id', $id)->update($values);

            if ($request->file('photo') !== null) {
                $urlImg = $this->uploadFileToS3($request);
                LogNotification::where('id',$id)->update(['photo' => $urlImg]);
            }

            return redirect()->route('notification.index');

        } catch (\Throwable $e) {
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
            LogNotification::find($id)->delete();
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => "Data Pengumuman successfully deleted."
                ]);
            }
            return redirect()->back()->with('success', 'Data Pengumuman successfully deleted.');
        } catch (\Exception $e) {

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Data Pengumuman failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Data Pengumuman failed to delete.');
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
        $publicURI = "https://" . env('AWS_BUCKET') .".". env('AWS_URL') . "/pengumuman"."/" .$filename;
        Storage::disk('s3')->put('pengumuman/' . $filename, file_get_contents($file));
        //https://glsdesa.s3-ap-southeast-1.amazonaws.com/images/-1607082298.jpg
        //SIMPAN INFORMASI USER KE DATABASE
        //DAN profile YANG DISIMPAN HANYALAH FILENAME-NYA SAJA
        //REDIRECT KE HALAMAN YANG SAMA DAN BERIKAN NOTIFIKASI
        return $publicURI;
    }
    return redirect()->back()->with(['error' => 'Gambar Belum Dipilih']);

    }

}
