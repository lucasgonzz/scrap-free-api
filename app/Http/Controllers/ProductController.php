<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
    public function index() {
        $models = Product::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Product::create([
            'name'                  => $request->name,
            'price'                 => $request->price,
            'is_good'               => $request->is_good,
            'user_id'               => $this->userId(),
        ]);
        return response()->json(['model' => $this->fullModel('Product', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Product::find($id);
        $model->name                = $request->name;
        $model->price               = $request->price;
        $model->is_good             = $request->is_good;
        $model->save();
        return response()->json(['model' => $this->fullModel('Product', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Product::find($id);
        $model->delete();
        return response(null);
    }
}
