<?php

namespace App\Http\Controllers;

use App\User;
use Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 'json') {
            $users = User::whereNotIn('id', [auth()->user()->id])
                    ->simplePaginate(15)
                    ->where('desa_id', auth()->user()->desa_id);

            return response()->json($user);
        } elseif ($request->type == 'datatable') {
            $users = User::whereNotIn('id', [auth()->user()->id])
                    ->where('desa_id', auth()->user()->desa_id);

            return datatables()->of($users)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="' . route('user.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="User" data-url="' . url('/user/' . $data->id) . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->make(true);
        }

        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'email' => 'nullable|email',
            'username' => 'required',
            'password' => 'required'
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password)
            ]);

            if ($request->has('savenew')) {
                return redirect()
                    ->back()
                    ->with('success', 'Pengguna berhasil dibuat.');
            }

            return redirect('user')
                ->with('success', 'Pengguna berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', "Error on line {$e->getLine()}. Message:<br><br>{$e->getMessage()}");
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', "Error on line {$e->getLine()}. Message:<br><br>{$e->getMessage()}");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);

        return view('user.edit', [
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
            'username' => 'required'
        ]);

        try {
            $user = User::find($id);

            $user->update([
                'name' => $request->name,
                'username' => $request->username
            ]);

            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
                $user->save();
            }

            return redirect('user')
                ->with('success', 'Pengguna berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', "Error on line {$e->getLine()}. Message:<br><br>{$e->getMessage()}");
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', "Error on line {$e->getLine()}. Message:<br><br>{$e->getMessage()}");
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
        try {
            User::find($id)->delete();

            return response()->json([
                'error' => true,
                'message' => 'User deleted.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => "Error on line {$e->getLine()}. Message:<br><br>{$e->getMessage()}"
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => "Error on line {$e->getLine()}. Message:<br><br>{$e->getMessage()}"
            ]);
        }
    }
}
