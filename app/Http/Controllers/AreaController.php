<?php

namespace App\Http\Controllers;

use App\Area;

use App\Helpers\CloudStorage;
use App\TipeArea;
use Illuminate\Http\Request;

class AreaController extends Controller
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
            $data = Area::with('tipeArea');

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-default btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a target="_blank" href="' . route('area.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="area" data-url="' . route('area.destroy', $data->id) . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } elseif ($request->type == 'json') {
            $data = Area::with('tipeArea')->get();

            return response()->json($data);
        } else {
            return view('area.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TipeArea::where('enabled', 1)->get();
        return view('area.create', [
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
            'tipe_area_id' => 'nullable|exists:tipe_area,id',
            'description' => 'nullable',
            'coordinates' => 'required',
            'enabled' => 'nullable',
            'photo' => 'nullable|file'
        ]);

        try {
            // Set enabled value.
            $enabled = $request->enabled ?: 0;

            // Save to storage.
            $area = Area::create([
                'name' => $request->name,
                'tipe_area_id' => $request->tipe_area_id,
                'description' => $request->description,
                'coordinates' => $request->coordinates,
                'enabled' => $enabled
            ]);

            // Has photo? Update the storage.
            if ($request->hasFile('photo')) {
                $url = CloudStorage::upload($request->file('photo'));

                $area->photo = $url;
                $area->save();
            }

            return redirect('/peta/area')
                ->with('success', 'Area berhasil dibuat.');
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
        $types = TipeArea::where('enabled', 1)->get();
        $data = Area::find($id);
        return view('area.edit', [
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
            'tipe_area_id' => 'nullable|exists:tipe_area,id',
            'description' => 'nullable',
            'coordinates' => 'required',
            'enabled' => 'nullable',
            'photo' => 'nullable|file'
        ]);

        try {
            // Set enabled value.
            $enabled = $request->enabled ?: 0;

            // Save to storage.
            $area = Area::find($id);

            $area->update([
                'name' => $request->name,
                'tipe_area_id' => $request->tipe_area_id,
                'description' => $request->description,
                'coordinates' => $request->coordinates,
                'enabled' => $enabled
            ]);

            // Has photo? Update the storage.
            if ($request->hasFile('photo')) {
                $url = CloudStorage::upload($request->file('photo'));

                $area->photo = $url;
                $area->save();
            }

            return redirect('/peta/area')
                ->with('success', 'Area berhasil diedit.');
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
        $data = Area::find($id);

        if ($data == null) {
            abort(404);
        }

        $data->delete();

        return response()->json([
            'error' => false,
            'message' => 'Area berhasil dihapus.'
        ]);
    }
}
