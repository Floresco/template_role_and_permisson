<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __invoke()
    {
//        dd(request()->routeIs('settings.e-commerce.*'));
        return view('dashboard/dashboard',  ['title' => trans('messages.Dashboard')]);
    }
}
