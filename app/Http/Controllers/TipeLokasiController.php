<?php

namespace App\Http\Controllers;

use App\Helpers\CloudStorage;

use App\TipeLokasi;
use Illuminate\Http\Request;

class TipeLokasiController extends Controller
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
            $data = TipeLokasi::select('*');

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a target="_blank" href="' . route('tipelokasi.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="tipe lokasi" data-url="' . route('tipelokasi.destroy', $data->id) . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return view('tipelokasi.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $icons = collect(scandir('images/markers'))->reject(function ($name) {
            return $name == '..' || $name == '.' || $name == '.DS_Store';
        });

        return view('tipelokasi.create', [
            'icons' => $icons
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
            'enabled' => 'nullable',
            'preset_icon' => 'nullable',
            'icon' => 'nullable|file'
        ]);

        try {
            // Set enabled value.
            $enabled = $request->enabled ?: 0;

            // Save to storage.
            $tipelokasi = TipeLokasi::create([
                'name' => $request->name,
                'enabled' => $enabled
            ]);

            // Has photo? Update the storage.
            if ($request->hasFile('icon')) {
                $url = CloudStorage::upload($request->file('icon'));

                $tipelokasi->icon = $url;
                $tipelokasi->save();
            } elseif ($request->get('preset_icon') !== '') {
                $tipelokasi->icon = $request->preset_icon;
                $tipelokasi->save();
            }

            return redirect('/peta/tipelokasi')
                ->with('success', 'Tipe lokasi berhasil dibuat.');
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
        $data = TipeLokasi::find($id);
        $icons = collect(scandir('images/markers'))->reject(function ($name) {
            return $name == '..' || $name == '.' || $name == '.DS_Store';
        });
        $isCustomIcon = $data->icon !== null
            ? filter_var($data->icon, FILTER_VALIDATE_URL)
            : null;


        return view('tipelokasi.edit', [
            'icons' => $icons,
            'isCustomIcon' => $isCustomIcon,
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
            'enabled' => 'nullable',
            'preset_icon' => 'nullable',
            'icon' => 'nullable|file'
        ]);

        try {
            // Set enabled value.
            $enabled = $request->enabled ?: 0;

            // Save to storage.
            $tipelokasi = TipeLokasi::find($id);

            $tipelokasi->update([
                'name' => $request->name,
                'enabled' => $enabled
            ]);

            // Has photo? Update the storage.
            if ($request->hasFile('icon')) {
                $url = CloudStorage::upload($request->file('icon'));

                $tipelokasi->icon = $url;
                $tipelokasi->save();
            } elseif ($request->get('preset_icon') !== '') {
                $tipelokasi->icon = $request->preset_icon;
                $tipelokasi->save();
            }

            return redirect('/peta/tipelokasi')
                ->with('success', 'Tipe lokasi berhasil diedit.');
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
        $data = TipeLokasi::find($id);

        if ($data == null) {
            abort(404);
        }

        $data->delete();

        return response()->json([
            'error' => false,
            'message' => 'Tipe lokasi berhasil dihapus.'
        ]);
    }
}
