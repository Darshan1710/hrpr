<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            //current role
            $userRole = Auth::user()->role;

            switch ($userRole) {
                    // Admins
                case "admin":
                    return redirect()->route('admin.category.index');
                    break;

                default:
                    return redirect('/logout');
                    break;
            }
        } else {
            return redirect()->route('home');
        }
    }
}
