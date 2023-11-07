<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Halaman;
class TransparasiKeuanganController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Transparasi Keuangan";
        if ($request->type == 'datatable') {
            $dataContent = Halaman::where('tipe','KEUANGAN')
                            ->orderBy('judul', 'ASC')
                            ->get();

            return datatables()->of($dataContent)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="' . route('transparasi-keuangan.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="kategori-artikel" data-url="/transparasi-keuangan/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->addColumn('tgl_dibuat', function ($data) {
                    return date('d F Y',strtotime($data->updated_at));
                })
                
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return view('web_front.transparasi-keuangan.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web_front.transparasi-keuangan.create',[
            'page_title' => "Tambah Transparasi Keuangan"
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
        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'slug' => $this->slugify($request->judul),
            'tipe' => "KEUANGAN"
        ];

        $first = Halaman::where('slug',$data['slug'])->first();

        if(!$first)
        Halaman::create($data);
        else 
        return redirect()->back()->withErrors(["Halaman sudah ada!"]);

        return redirect()->route('transparasi-keuangan.index');
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
        $data = Halaman::find($id);
        if(!$data)
            abort(404);

        return view('web_front.transparasi-keuangan.edit',[
            'page_title' => "Edit ".$data->judul,
            'data' => $data
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
        
        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'slug' => $this->slugify($request->judul),
            'tipe' => "KEUANGAN"
        ];

        $first = Halaman::where('slug',$data['slug'])->count();
        if($first === 1 || $first === 0)
        Halaman::where('id',$id)->update($data);
        else 
        return redirect()->back()->withErrors(["Halaman sudah ada!"]);

        return redirect()->route('transparasi-keuangan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Halaman::find($id);

        if ($data == null) {
            abort(404);
        }

        $data->delete();

        return response()->json([
            'error' => false,
            'message' => 'Halaman berhasil dihapus.'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
