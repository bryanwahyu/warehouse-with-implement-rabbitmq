<?php

namespace App\Http\Controllers\Web;

use Infra\Shared\Controllers\BaseController;

class AuthFrontEndController extends BaseController
{
    public function login()
    {
        return view('login');
    }
}
