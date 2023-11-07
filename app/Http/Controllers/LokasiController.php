<?php

namespace App\Http\Controllers;

use App\Helpers\CloudStorage;

use App\Lokasi;
use App\TipeLokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 'datatable') {
            $data = Lokasi::with('tipeLokasi');

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-default btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a target="_blank" href="' . route('lokasi.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="lokasi" data-url="' . route('lokasi.destroy', $data->id) . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } elseif ($request->type == 'json') {
            $data = Lokasi::with('tipeLokasi')->get();

            return response()->json($data);
        } else {
            return view('lokasi.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TipeLokasi::where('enabled', 1)->get();
        return view('lokasi.create', [
            'types' => $types
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
        $this->validate($request, [
            'name' => 'required',
            'tipe_lokasi_id' => 'nullable|exists:tipe_lokasi,id',
            'description' => 'nullable',
            'lat' => 'required',
            'lng' => 'required',
            'enabled' => 'nullable',
            'photo' => 'nullable|file'
        ]);

        try {
            // Set enabled value.
            $enabled = $request->enabled ?: 0;

            // Save to storage.
            $lokasi = Lokasi::create([
                'name' => $request->name,
                'tipe_lokasi_id' => $request->tipe_lokasi_id,
                'description' => $request->description,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'enabled' => $enabled
            ]);

            // Has photo? Update the storage.
            if ($request->hasFile('photo')) {
                $url = CloudStorage::upload($request->file('photo'));

                $lokasi->photo = $url;
                $lokasi->save();
            }

            return redirect('/peta/lokasi')
                ->with('success', 'Lokasi berhasil dibuat.');
        } catch (\Exception $e) {
            $errorMessage = "Error on file ";
            $errorMessage .= basename($e->getFile());
            $errorMessage .= ", line {$e->getLine()}.<br><br>Message: {$e->getMessage()}";

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $errorMessage);
        } catch (\Throwable $e) {
            $errorMessage = "Error on file ";
            $errorMessage .= basename($e->getFile());
            $errorMessage .= ", line {$e->getLine()}.<br><br>Message: {$e->getMessage()}";

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $errorMessage);
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
        $types = TipeLokasi::where('enabled', 1)->get();
        $data = Lokasi::find($id);
        return view('lokasi.edit', [
            'types' => $types,
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
        $this->validate($request, [
            'name' => 'required',
            'tipe_lokasi_id' => 'nullable|exists:tipe_lokasi,id',
            'description' => 'nullable',
            'lat' => 'required',
            'lng' => 'required',
            'enabled' => 'nullable',
            'photo' => 'nullable|file'
        ]);

        try {
            // Set enabled value.
            $enabled = $request->enabled ?: 0;

            // Save to storage.
            $lokasi = Lokasi::find($id);

            $lokasi->update([
                'name' => $request->name,
                'tipe_lokasi_id' => $request->tipe_lokasi_id,
                'description' => $request->description,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'enabled' => $enabled
            ]);

            // Has photo? Update the storage.
            if ($request->hasFile('photo')) {
                $url = CloudStorage::upload($request->file('photo'));

                $lokasi->photo = $url;
                $lokasi->save();
            }

            return redirect('/peta/lokasi')
                ->with('success', 'Lokasi berhasil diedit.');
        } catch (\Exception $e) {
            $errorMessage = "Error on file ";
            $errorMessage .= basename($e->getFile());
            $errorMessage .= ", line {$e->getLine()}.<br><br>Message: {$e->getMessage()}";

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $errorMessage);
        } catch (\Throwable $e) {
            $errorMessage = "Error on file ";
            $errorMessage .= basename($e->getFile());
            $errorMessage .= ", line {$e->getLine()}.<br><br>Message: {$e->getMessage()}";

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $errorMessage);
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
        $data = Lokasi::find($id);

        if ($data == null) {
            abort(404);
        }

        $data->delete();

        return response()->json([
            'error' => false,
            'message' => 'Lokasi berhasil dihapus.'
        ]);
    }
}
