<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\Helpers\GeneralHelper;
use App\Models\Asegurado;
use Illuminate\Http\Request;

class AseguradoController extends Controller
{
   
    public function index() {
        $models = Asegurado::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Asegurado::create([
            'num'                   => $this->num('asegurados'),
            'nombre'                => $request->nombre,
            'telefono'              => $request->telefono,
            'telefono_alternativo'  => $request->telefono_alternativo,
            'email'                 => $request->email,
            'direccion'             => $request->direccion,
            'notas_direccion'       => $request->notas_direccion,
            'notas'                 => $request->notas,
            'user_id'               => $this->userId(),
        ]);
        GeneralHelper::attachModels($model, 'aseguradoras', $request->aseguradoras);
        return response()->json(['model' => $this->fullModel('Asegurado', $model->id)], 201);
    }  

    public function update(Request $request, $id) {
        $model = Asegurado::find($id);
        $model->nombre                = $request->nombre;
        $model->telefono              = $request->telefono;
        $model->telefono_alternativo  = $request->telefono_alternativo;
        $model->email                 = $request->email;
        $model->direccion             = $request->direccion;
        $model->notas_direccion       = $request->notas_direccion;
        $model->notas                 = $request->notas;
        $model->save();
        GeneralHelper::attachModels($model, 'aseguradoras', $request->aseguradoras);
        return response()->json(['model' => $this->fullModel('Asegurado', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Asegurado::find($id);
        $model->delete();
        return response(null, 200);
    }
}
