<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
       public function index()
       {
           $products = Product::with('category')->paginate(5);
           return view('admin/dashboard')->with(compact('products'));
       }

        public function changeStatus(Request $request) {
            $product = Product::find($request->input('id'))->update(['status' => $request->input('status')]);
            return response()->json([
                'status' => 'success'
            ]);
        }
}
