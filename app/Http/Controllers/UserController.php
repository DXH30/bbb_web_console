<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{
    //
    public function register(Request $request) {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        if ($user->save()) {
            return redirect()->to(route('login'));
        } else {
            return redirect()->back()->withErrors(['gagal registrasi']);
        }
    }

    public function login(Request $request) {
        if (filter_var($request->input('username'), FILTER_VALIDATE_EMAIL)) {
            $cred['email'] = $request->input('username');
        } else {
            $cred['name'] = $request->input('username');
        }
        $cred['password'] = $request->input('password');
        $cred['verified'] = true;
        if (Auth::attempt($cred)) {
            return redirect()->to(route('page_dashboard'));
        } else {
            return redirect()->back()->withErrors(['Gagal login']);
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->to(route('login'));
    }

    public function verifikasi(Request $request) {
        $id = $request->input('id');
        $user = User::find($id);
        $user->verified = 1;
        $user->save();
        return redirect()->back();
    }

    public function unverifikasi(Request $request) {
        $id = $request->input('id');
        $user = User::find($id);
        $user->verified = 0;
        $user->save();
        return redirect()->back();
    }

    public function to_moderator(Request $request) {
        $id = $request->input('id');
        $user = User::find($id);
        $user->type = 'moderator';
        $user->save();
        return redirect()->back();
    }

    public function to_attendee(Request $request) {
        $id = $request->input('id');
        $user = User::find($id);
        $user->type = 'attendee';
        $user->save();
        return redirect()->back();
    }

    public function delete(Request $request) {
        $id = $request->input('id');
        User::find($id)->delete();
        return redirect()->back();
    }

}
