<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function index($from_date, $until_date = null) {
        $models = Sale::where('user_id', $this->userId())
                        ->orderBy('created_at', 'DESC')
                        ->withAll();
        if (!is_null($until_date)) {
            $models = $models->whereDate('created_at', '>=', $from_date)
                            ->whereDate('created_at', '<=', $until_date);
        } else {
            $models = $models->whereDate('created_at', $from_date);
        }

        $models = $models->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Sale::create([
            'user_id'               => $this->userId(),
        ]);
        $this->attachProducts($model, $request->products);
        return response()->json(['model' => $this->fullModel('Sale', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Sale::find($id);
        $model->name                = $request->name;
        $model->save();
        $this->attachProducts($model, $request->products);
        return response()->json(['model' => $this->fullModel('Sale', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Sale::find($id);
        $model->delete();
        return response(null);
    }

    function attachProducts($model, $products) {
        $model->products()->detach();
        foreach ($products as $product) {
            $model->products()->attach($product['id'], [
                'amount' => $product['pivot']['amount'],
            ]);
        }
    }
}
