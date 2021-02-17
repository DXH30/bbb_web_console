<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Meeting;

class PageController extends Controller
{
    //
    public function landing(Request $request) {
        $obj['title'] = 'Landing';
        return view('landing', $obj);
    }

    public function login(Request $request) {
        if (auth()->check()) {
            return redirect()->to(route('page_dashboard'));
        }
        $obj['title'] = 'Login';
        return view('login', $obj);
    }

    public function register(Request $request) {
        if (auth()->check()) {
            return redirect()->to(route('page_dashboard'));
        }
        $obj['title'] = 'Register';
        return view('register', $obj);
    }

    public function dashboard(Request $request) {
        if (!auth()->check()) {
            return redirect()->to(route('login'));
        }
        $obj['title'] = 'Dashboard';
        return view('dashboard', $obj);
    }

    public function user(Request $request) {
        $obj['title'] = 'User Management';
        $obj['users'] = User::where('type', '<>', 'admin')->get();
        return view('user', $obj);
    }

    public function meeting(Request $request) {
        $obj['title'] = 'Meeting Management';
        if (auth()->check()) {
            if (auth()->user()->type == 'admin') {
                $obj['meetings'] = Meeting::get();
            } else {
                $obj['meetings'] = Meeting::where('user_id', auth()->user()->id)->get();
            }
            return view('meeting', $obj);
        } else {
            return redirect()->to(route('login'));
        }
    }

    public function meeting_public(Request $request) {
        $id = $request->input('id');
        $meeting = Meeting::find($id);
        $obj['title'] = $meeting->name;
        $obj['meeting'] = $meeting;
        return view('meeting_public', $obj);
    }
}
