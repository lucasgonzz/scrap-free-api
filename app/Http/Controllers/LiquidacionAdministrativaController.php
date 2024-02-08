<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\ImageController;
use App\Models\Bien;
use App\Models\LiquidacionAdministrativa;
use Illuminate\Http\Request;

class LiquidacionAdministrativaController extends Controller
{

    public function index() {
        $models = LiquidacionAdministrativa::where('user_id', $this->userId())
                            ->orderBy('created_at', 'DESC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $this->check_si_ya_tiene($request->siniestro_id);

        $model = LiquidacionAdministrativa::create([
            'siniestro_id'          => $request->siniestro_id,
        ]);

        $this->attachCoberturas($model, $request->coberturas);
        $this->attachBienes($model, $request->bienes);
        
        return response()->json(['model' => $this->fullModel('LiquidacionAdministrativa', $model->id)], 201);
    }  

    function check_si_ya_tiene($siniestro_id) {
        $model = LiquidacionAdministrativa::where('siniestro_id', $siniestro_id)
                                            ->first();
        if (!is_null($model)) {
            $model->coberturas()->detach();
            foreach ($model->bienes as $bien) {
                $bien->coberturas_aplicadas()->detach();
            }
            $model->bienes()->detach();
            $model->delete();
        }
    }

    function attachCoberturas($liquidacion_administrativa, $coberturas) {
        foreach ($coberturas as $cobertura) {
            $liquidacion_administrativa->coberturas()->attach($cobertura['id'], [
                'suma_asegurada'    => $cobertura['suma_asegurada'],
                'perdidas'          => $cobertura['perdidas'],
                'deducible'         => $cobertura['deducible'],
                'indemnizacion'     => $cobertura['indemnizacion'],
            ]);
        }
    }

    function attachBienes($liquidacion_administrativa, $bienes) {
        foreach ($bienes as $bien) {
            $store_bien = Bien::find($bien['id']);
            foreach ($bien['coberturas_aplicadas'] as $cobertura_aplicada) {
                $store_bien->coberturas_aplicadas()->attach($cobertura_aplicada['id'], [
                    'remanente_a_cubrir'    => $cobertura_aplicada['remanente_a_cubrir'], 
                    'deducible'             => $cobertura_aplicada['deducible'],
                    'deducible_aplicado'    => $cobertura_aplicada['deducible_aplicado'],
                    'fondos'                => $cobertura_aplicada['fondos'],
                ]);
            }

            $liquidacion_administrativa->bienes()->attach($bien['id'], [
                'indemnizacion'     => $bien['indemnizacion'],
                'anos_antiguedad'     => $bien['anos_antiguedad'],
                'procentage_depreciacion'     => $bien['procentage_depreciacion'],
                'valor_depreciado'     => $bien['valor_depreciado'],
            ]);
        }
    }

    public function show($id) {
        return response()->json(['model' => $this->fullModel('LiquidacionAdministrativa', $id)], 200);
    }

    public function update(Request $request, $id) {
        $model = LiquidacionAdministrativa::find($id);
        $model->name                = $request->name;
        $model->save();
        $this->sendAddModelNotification('LiquidacionAdministrativa', $model->id);
        return response()->json(['model' => $this->fullModel('LiquidacionAdministrativa', $model->id)], 200);
    }

    public function destroy($id) {
        $model = LiquidacionAdministrativa::find($id);
        ImageController::deleteModelImages($model);
        $model->delete();
        $this->sendDeleteModelNotification('LiquidacionAdministrativa', $model->id);
        return response(null);
    }
}
