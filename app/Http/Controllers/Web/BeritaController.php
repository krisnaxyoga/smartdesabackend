<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\KategoriArtikel;
use App\Artikel;
use DB,Auth;
use Illuminate\Support\Facades\Storage;
class BeritaController extends Controller
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
        $data['page_title'] = "Berita";
        if ($request->type == 'datatable') {
            $dataContent = Artikel::select('artikel.*','users.name as penulis','kategori_artikel.nama as kategori')
                            ->where('type','berita')
                            ->join('users','users.id','=','artikel.user_id')
                            ->join('kategori_artikel','kategori_artikel.id','=','artikel.kategori_artikel_id')
                            ->orderBy('judul', 'ASC')
                ->get();

            return datatables()->of($dataContent)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="' . route('berita.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="kategori-artikel" data-url="/berita/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->addColumn('status_berita', function ($data) {
                    $status = "<span class='badge text-sm danger'>TIDAK AKTIF</span>";
                    if($data->status == "1") {
                        $status = "<span class='badge text-sm primary'>AKTIF</span>";
                    }
                    return $status;
                })
                ->addColumn('slider', function ($data) {
                    $status = "<span class='badge text-sm danger'>TIDAK TAMPIL</span>";
                    if($data->show_slider == "1") {
                        $status = "<span class='badge text-sm primary'>TAMPIL</span>";
                    }
                    return $status;
                })
                ->addColumn('tgl_dibuat', function ($data) {
                    return date('d F Y',strtotime($data->created_at));
                })

                ->rawColumns(['action','slider','status_berita'])
                ->make(true);
        } else if ($request->type == 'json') {
            $dataContent = Artikel::select('artikel.*','users.name as penulis','kategori_artikel.nama as kategori')
                            ->where('type','berita')
                            ->join('users','users.id','=','artikel.user_id')
                            ->join('kategori_artikel','kategori_artikel.id','=','artikel.kategori_artikel_id')
                            ->orderBy('judul', 'ASC');

            if ($request->keyword) {
                $dataContent = $dataContent->where(
                    'nama',
                    'LIKE',
                    DB::raw('"%' . $request->keyword . '%"')
                );
            }

            $dataContent = $dataContent::get();

            return response()->json($dataContent);
        } else {
            return view('web_front.berita.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = KategoriArtikel::get();
        return view('web_front.berita.create',[
            'kategori' => $kategori,
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
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'konten' => $request->konten,
            'slug' => $this->slugify($request->judul),
            'kategori_artikel_id' => $request->kategori_artikel_id,
            'type' => 'BERITA',
            'status' => (int) isset($request->status),
            'show_slider' => (int) isset($request->show_slider),
        ];

        if ($request->file('profile') !== null) {
            $url = $this->uploadFileToS3($request);
            // dd($url);
            $req['gambar'] = $url;
        }

        DB::beginTransaction();
        try {
            Artikel::create($req);
            DB::commit();

            return redirect()->route('berita.index');
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
        $data = Artikel::find($id);
        $kategori = KategoriArtikel::get();
        return view('web_front.berita.edit',[
            'data' => $data,
            'kategori' => $kategori,
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
        $data = Artikel::find($id);
        $req = [
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori_artikel_id' => $request->kategori_artikel_id,
            'type' => 'BERITA',
            'status' => (int) isset($request->status),
            'show_slider' => (int) isset($request->show_slider),
        ];

        if($data->judul != $request->judul) {
            $req['slug'] = $this->slugify($request->judul);
        }

        if ($request->file('profile') !== null) {
            $url = $this->uploadFileToS3($request);
            // dd($url);
            $req['gambar'] = $url;
        }

        DB::beginTransaction();
        try {
            Artikel::find($id)->update($req);
            DB::commit();

            return redirect()->route('berita.index');
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
        $data = Artikel::find($id);
        Storage::disk('s3')->delete($data->gambar);

        if ($data == null) {
            abort(404);
        }

        $data->delete();

        return response()->json([
            'error' => false,
            'message' => 'Berita berhasil dihapus.'
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
        $filename = $request->email . 'gls' . time() . '.' . $file->getClientOriginalExtension();
        //UPLOAD MENGGUNAKAN CONFIG S3, DENGAN FILE YANG DIMASUKKAN KE DALAM FOLDER IMAGES
        //SECARA OTOMATIS AMAZON AKAN MEMBUAT FOLDERNYA JIKA BELUM ADA
        $publicURI = "https://" . env('AWS_BUCKET') .".". env('AWS_URL') . "/berita"."/" .$filename;
        Storage::disk('s3')->put('berita/' . $filename, file_get_contents($file), 'public');
        //https://glsdesa.s3-ap-southeast-1.amazonaws.com/images/-1607082298.jpg
        //SIMPAN INFORMASI USER KE DATABASE
        //DAN profile YANG DISIMPAN HANYALAH FILENAME-NYA SAJA
        //REDIRECT KE HALAMAN YANG SAMA DAN BERIKAN NOTIFIKASI
        return $publicURI;
    }
    return redirect()->back()->with(['error' => 'Gambar Belum Dipilih']);

    }

    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
