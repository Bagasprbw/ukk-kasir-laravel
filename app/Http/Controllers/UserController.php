<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $user = User::all();
        return view('user.user', compact('user'));
    }

    public function tambah(){
        return view('user.tambah');
    }

    public function insert(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/kasir')->with('msg', 'User(Kasir) Berhasil ditambahkan');
    }

    public function edit(User $user){
        return view('/user.edit', compact('user'));
    }

    public function update(User $user, Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->update();
        return redirect('/user')->with('msg', 'User Berhasil diedit');
    }

    public function delete(User $user){
        $user->delete();
        return back()->with('msg', 'User Berhasil dihapus');
    }
}
