<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\KategoriBarang;

class KategoriBarangController extends Controller
{
    public function index(Request $request) {
        $data['page_title'] = 'Kategori Barang';
        if ($request->type == 'datatable') {
            $data = KategoriBarang::select('kategori_barang.*','desa.nama_desa')
            ->join('desa','desa.id','=','kategori_barang.desa_id')->orderBy('kategori_barang.name','ASC')->get();
            
            return datatables()->of($data)
            ->addColumn('action', function ($data) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="' . route('kategori-barang.edit', $data->id) . '">Edit</a></li>
                                <li><a data-id="' . $data->id . '" data-label="Kategori Barang" data-url="/e-planning/kategori-barang/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                            </ul>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
        } else {
            return view('e-planning.kategori-barang.index', $data);    
        }
    }

    public function create() {
        $data['page_title'] = "Tambah Kategori Barang";
       
        return view('e-planning.kategori-barang.create',$data);
    }

    public function store(Request $request)
    {
        try {
            $tes = KategoriBarang::create([
                'name' => $request->name
            ]);
            return redirect()->route('kategori-barang.index');
        } catch (\Throwable $e) {
            return back()->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        }
    }

    public function edit($id) {
        $data['category'] = KategoriBarang::find($id);
        $data['page_title'] = 'Update Kategori Barang';

        return view('e-planning.kategori-barang.edit', $data);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = ['name' => $request->name];

        try {
            KategoriBarang::find($id)->update($data);
            return redirect()->route('kategori-barang.index');
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        }
    }

    public function destroy(Request $request, $id) {
        try {
            KategoriBarang::where('id', $id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Kategori Barang successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Kategori Barang successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Kategori Barang failed to delete.'
                ]);
            } 

            return redirect()->back()->with('error', 'Kategori Barang failed to delete.');
        }
    }
}
