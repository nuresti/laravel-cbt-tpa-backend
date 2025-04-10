<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index(Request $request)
    {
        // get user with pagination
        $users = DB::table('users')
            ->where('name', 'like', '%' . $request->search . '%')
            ->paginate(5);

        return view('pages.user.index', compact('users'));
    }
    function create()
    {
        return view('pages.user.create');
    }
    function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));
        User::create($data);
        return redirect()->route('user.index');
    }
    function show($id)
    {
        return view('pages.dashboard');
    }
    function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }
    function update(Request $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        //check if passwrod is not empty
        if ($request->input('password')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            $data['password'] = $user->password;
        }
        $user->update($data);
        return redirect()->route('user.index');
    }
    function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
