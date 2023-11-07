<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\KategoriArtikel;
use App\Halaman;
use DB,Auth;
use Illuminate\Support\Facades\Storage;
class HalamanController extends Controller
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
    public function sejarah(Request $request)
    {
        $halaman = Halaman::where('tipe','SEJARAH')->first();
        $kategori = KategoriArtikel::get();
        return view('web_front.sejarah.create',[
            'data' => $halaman ?: new Halaman(),
            'kategori' => $kategori,
            'page_title' => "Sejarah"
        ]);
    }

    public function visimisi(Request $request)
    {
        $halaman = Halaman::where('tipe','VISIMISI')->first();
        $kategori = KategoriArtikel::get();
        return view('web_front.visimisi.create',[
            'data' => $halaman ?: new Halaman(),
            'kategori' => $kategori,
            'page_title' => "Visi Misi"
        ]);
    }

    public function lembagaDesa(Request $request)
    {
        $halaman = Halaman::where('tipe','LEMBAGA_DESA')->first();
        return view('web_front.lembaga-desa.create',[
            'data' => $halaman ?: new Halaman(),
            'page_title' => "Lembaga Desa"
        ]);
    }


    public function updateSejarah(Request $request)
    {
        // return response()->json($request->all());
        $req = [
            'konten' => $request->konten,
            'judul' => $request->judul,
            'slug' => 'sejarah',
            'tipe' => 'SEJARAH'
        ];
        if ($request->file('profile') !== null) {
            $url = $this->uploadFileToS3($request);
            // dd($url);
            $req['gambar'] = $url;
        }

        $ress = Halaman::where('tipe','SEJARAH')->first();

        if(!$ress) {
            Halaman::create($req);
        } else {
            Halaman::where('tipe','SEJARAH')->update($req);
        }


        return redirect()->back()->with('success','Sejarah Berhasil Disimpan');
    }

    public function updateVisiMisi(Request $request)
    {
        // return response()->json($request->all());
        $req = [
            'konten' => $request->konten,
            'judul' => $request->judul,
            'slug' => 'visi-misi',
            'tipe' => 'VISIMISI'
        ];
        if ($request->file('profile') !== null) {
            $url = $this->uploadFileToS3($request);
            // dd($url);
            $req['gambar'] = $url;
        }

        $ress = Halaman::where('tipe','VISIMISI')->first();

        if(!$ress) {
            Halaman::create($req);
        } else {
            Halaman::where('tipe','VISIMISI')->update($req);
        }


        return redirect()->back()->with('success','Visi Misi Berhasil Disimpan');
    }

    public function updateLembagaDesa(Request $request)
    {
        // return response()->json($request->all());
        $req = [
            'konten' => $request->konten,
            'judul' => $request->judul,
            'slug' => 'lembaga-desa',
            'tipe' => 'LEMBAGA_DESA'
        ];
        if ($request->file('profile') !== null) {
            $url = $this->uploadFileToS3($request);
            // dd($url);
            $req['gambar'] = $url;
        }

        $ress = Halaman::where('tipe','LEMBAGA_DESA')->first();

        if(!$ress) {
            Halaman::create($req);
        } else {
            Halaman::where('tipe','LEMBAGA_DESA')->update($req);
        }


        return redirect()->back()->with('success','Lembaga Desa Berhasil Disimpan');
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        $publicURI = "https://" . env('AWS_BUCKET') .".". env('AWS_URL') . "/halaman"."/" .$filename;
        Storage::disk('s3')->put('halaman/' . $filename, file_get_contents($file), 'public');
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

    public function hapusGambar($data)
    {
        $data = Halaman::where('tipe',$data)->update(['gambar' => null]);

        return redirect()->back()->with('success','Gambar Berhasil di Hapus');
    }
}
