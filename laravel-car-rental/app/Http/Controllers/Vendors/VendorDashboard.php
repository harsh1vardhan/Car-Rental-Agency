<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorDashboard extends Controller
{
    public function index()
    {
        $orders = Order::with('car')->get();
        return view('dashboard.vendors.home', compact('orders'));
    }

    public function logout()
    {
        Auth::guard('vendor')->logout();
        return redirect()->route('vendors.login');
    }
}
