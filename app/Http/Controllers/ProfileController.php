<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
class ProfileController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit',[
            'data' => $user
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'password' => 'string|nullable'
        ]);

        $req = [
            'name' => $request->name
        ];

        if(isset($request->password) && $request->password != '') {
            $req['password'] = bcrypt($request->password);
        }

        User::where('id',Auth::user()->id)->update($req);
        return redirect()->back()->with('success','Profile Berhasil di Update');

    }
}
