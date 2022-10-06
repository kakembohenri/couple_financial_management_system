<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;


class LogoutController extends Controller
{

    public function __constructor()
    {
        $this->middleware(['auth']);
    }

    public function store()
    {

        auth()->logout();

        return redirect()->route('/');
    }
}
