<?php

namespace App\Http\Controllers\admins;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\{Items,Admins,Category};
use App\User;

class DashboardController extends Controller
{
    ####################################     index      ################################
    public function index():View
    {
        $admins     = Admins::count();
        $items      = Items::count();
        $users      = User::count();
        $categories = Category::count();

        return view('admins.auth.dashboard',compact('admins','items','users','categories'));
    }
}
