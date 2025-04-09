<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('pages.users.index', compact('data'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        // dd($request->password);
        $userPass = bcrypt($request->password);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $userPass
        ]);

        return redirect()->route('users.index')->with('success', 'Berhasil Menambahkan Data User!');
    }

    public function edit(string $id)
    {
        $userId = User::find($id);
        return view('pages.users.edit', compact('userId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userUpdate = User::find($id);

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
        ]);

        if ($request->password > 0) {

            $userPass = bcrypt($request->password);

            $userUpdate->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => $userPass
            ]);
        } else {
            $userUpdate->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Berhasil Mengubah Data User!');
    }

    public function destroy(string $id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data User!');
    }
}