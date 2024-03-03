<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function saveOne(Request $request)
    {

        $startDate = $request->start_date;
        $car_id = $request->car_id;
        $number_of_days = $request->number_of_days;

        $request->validate([
            'start_date' => 'required',
            'car_id' => 'required',
            'number_of_days' => 'required',
        ], [
            'start_date.required' => 'this field is required',
            'car_id.required' => 'this field is required',
            'number_of_days.required' => 'this field is required',
        ]);

        try {
            Order::create([
                'start_date' => $startDate,
                'car_id' => $car_id,
                'number_of_days' => $number_of_days,
                'user_id' => auth()->user()->id
            ]);

            return redirect()->back()->with('success', 'Car rent request placed successfully');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Car rent request failed');
        }
    }
}
