<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct()
    {
    $this->middleware(function ($request, $next) {
            $this->uid = $request->attributes->get('uid');
            return $next($request);
        });
    }
}
