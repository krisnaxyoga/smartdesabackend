<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Barang;
use App\KategoriBarang;

class BarangController extends Controller
{
    public function index(Request $request) {
        $data['page_title'] = 'Barang';
        if ($request->type == 'datatable') {
            $data = Barang::select('barang.*','desa.nama_desa', 'kategori_barang.name as kategori')
            ->join('desa','desa.id','=','barang.desa_id')
            ->join('kategori_barang', 'kategori_barang.id', '=', 'barang.kategori_barang_id')
            ->orderBy('barang.name','ASC')
            ->get();
            return datatables()->of($data)
            ->addColumn('action', function ($data) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="' . route('barang.edit', $data->id) . '">Edit</a></li>
                                <li><a data-id="' . $data->id . '" data-label="Barang" data-url="/e-planning/barang/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                            </ul>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
        } else {
            return view('e-planning.barang.index', $data);    
        }
        
    }

    public function create() {
        $data['page_title'] = 'Tambah Barang';
        $data['kategori_barang'] = KategoriBarang::all();
        return view('e-planning.barang.create', $data);
    }

    public function store(Request $request)
    {
        try {
            Barang::create([
                'name' => $request->name,
                'kode_barang' => $request->kode_barang,
                'harga' => $request->harga,
                'kategori_barang_id' => $request->kategori_barang_id
            ]);
            return redirect()->route('barang.index');
        } catch (\Throwable $e) {
            return back()->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        }
    }

    public function edit($id) {
        $data['category'] = Barang::find($id);
        $data['kategori_barang_id'] = KategoriBarang::get();
        $data['page_title'] = 'Update Barang';
        

        return view('e-planning.barang.edit', $data);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'kode_barang' => 'required',
            'harga' => 'required',
            'kategori_barang_id' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'kode_barang' => $request->kode_barang,
            'harga' => $request->harga,
            'kategori_barang_id' => $request->kategori_barang_id
        ];
       
        try {
            Barang::find($id)->update($data);
            // KategoriBarang::get($id)->update($data);
            return redirect()->route('barang.index');
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        }

    }

    public function destroy(Request $request, $id) {
        try {
            Barang::where('id', $id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Barang successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Barang successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Barang failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Barang failed to delete.');
        }
    }

    
}
