<?php

namespace App\Http\Controllers;

use App\Helpers\CloudStorage;

use App\TipeArea;
use Illuminate\Http\Request;

class TipeAreaController extends Controller
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
            $data = TipeArea::select('*');

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a target="_blank" href="' . route('tipearea.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="tipe area" data-url="' . route('tipearea.destroy', $data->id) . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return view('tipearea.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipearea.create');
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
            'color' => 'required|size:6',
            'enabled' => 'nullable',
        ]);

        try {
            // Set enabled value.
            $enabled = $request->enabled ?: 0;

            // Save to storage.
            $tipearea = TipeArea::create([
                'name' => $request->name,
                'color' => $request->color,
                'enabled' => $enabled
            ]);

            return redirect('/peta/tipearea')
                ->with('success', 'Tipe area berhasil dibuat.');
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
        $data = TipeArea::find($id);
        return view('tipearea.edit', [
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
            'color' => 'required|size:6'
        ]);

        try {
            // Set enabled value.
            $enabled = $request->enabled ?: 0;

            // Save to storage.
            $tipearea = TipeArea::find($id);

            $tipearea->update([
                'name' => $request->name,
                'color' => $request->color,
                'enabled' => $enabled
            ]);

            return redirect('/peta/tipearea')
                ->with('success', 'Tipe area berhasil diedit.');
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
        $data = TipeArea::find($id);

        if ($data == null) {
            abort(404);
        }

        $data->delete();

        return response()->json([
            'error' => false,
            'message' => 'Tipe area berhasil dihapus.'
        ]);
    }
}
