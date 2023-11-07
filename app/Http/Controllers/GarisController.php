<?php

namespace App\Http\Controllers;

use App\Garis;

use App\Helpers\CloudStorage;
use App\TipeGaris;
use Illuminate\Http\Request;

class GarisController extends Controller
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
            $data = Garis::with('tipeGaris');

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-default btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a target="_blank" href="' . route('garis.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="garis" data-url="' . route('garis.destroy', $data->id) . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } elseif ($request->type == 'json') {
            $data = Garis::with('tipeGaris')->get();

            return response()->json($data);
        } else {
            return view('garis.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TipeGaris::where('enabled', 1)->get();
        return view('garis.create', [
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
            'tipe_garis_id' => 'nullable|exists:tipe_garis,id',
            'description' => 'nullable',
            'coordinates' => 'required',
            'enabled' => 'nullable',
            'photo' => 'nullable|file'
        ]);

        try {
            // Set enabled value.
            $enabled = $request->enabled ?: 0;

            // Save to storage.
            $garis = Garis::create([
                'name' => $request->name,
                'tipe_garis_id' => $request->tipe_garis_id,
                'description' => $request->description,
                'coordinates' => $request->coordinates,
                'enabled' => $enabled
            ]);

            // Has photo? Update the storage.
            if ($request->hasFile('photo')) {
                $url = CloudStorage::upload($request->file('photo'));

                $garis->photo = $url;
                $garis->save();
            }

            return redirect('/peta/garis')
                ->with('success', 'Garis berhasil dibuat.');
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
        $types = TipeGaris::where('enabled', 1)->get();
        $data = Garis::find($id);
        return view('garis.edit', [
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
            'tipe_garis_id' => 'nullable|exists:tipe_garis,id',
            'description' => 'nullable',
            'coordinates' => 'required',
            'enabled' => 'nullable',
            'photo' => 'nullable|file'
        ]);

        try {
            // Set enabled value.
            $enabled = $request->enabled ?: 0;

            // Save to storage.
            $garis = Garis::find($id);

            $garis->update([
                'name' => $request->name,
                'tipe_garis_id' => $request->tipe_garis_id,
                'description' => $request->description,
                'coordinates' => $request->coordinates,
                'enabled' => $enabled
            ]);

            // Has photo? Update the storage.
            if ($request->hasFile('photo')) {
                $url = CloudStorage::upload($request->file('photo'));

                $garis->photo = $url;
                $garis->save();
            }

            return redirect('/peta/garis')
                ->with('success', 'Garis berhasil diedit.');
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
        $data = Garis::find($id);

        if ($data == null) {
            abort(404);
        }

        $data->delete();

        return response()->json([
            'error' => false,
            'message' => 'Garis berhasil dihapus.'
        ]);
    }
}
