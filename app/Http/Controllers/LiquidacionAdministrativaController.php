<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\ImageController;
use App\Models\Bien;
use App\Models\LiquidacionAdministrativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $coberturas = array_reverse($coberturas);
        foreach ($coberturas as $cobertura) {
            // Log::info('Se agrego '.$cobertura['nombre']);
            $liquidacion_administrativa->coberturas()->attach($cobertura['id'], [
                'suma_asegurada'                => $cobertura['suma_asegurada'],
                'perdidas'                      => $cobertura['perdidas'],
                'deducible'                     => $cobertura['deducible'],
                'indemnizacion'                 => $cobertura['indemnizacion'],
                // 'indemnizacion_reparacion'      => $cobertura['indemnizacion_reparacion'],
                // 'indemnizacion_a_nuevo'         => $cobertura['indemnizacion_a_nuevo'],
            ]);
            sleep(.5);
        }
    }

    function attachBienes($liquidacion_administrativa, $bienes) {
        foreach ($bienes as $bien) {
            $store_bien = Bien::find($bien['id']);
            $coberturas_aplicadas = array_reverse($bien['coberturas_aplicadas']);
            foreach ($coberturas_aplicadas as $cobertura_aplicada) {
                $store_bien->coberturas_aplicadas()->attach($cobertura_aplicada['id'], [
                    'remanente_a_cubrir_reparacion'     => $cobertura_aplicada['remanente_a_cubrir_reparacion'], 
                    'remanente_a_cubrir_a_nuevo'        => $cobertura_aplicada['remanente_a_cubrir_a_nuevo'], 
                    'deducible'                         => $cobertura_aplicada['deducible'],
                    'fondos_reparacion'                 => $cobertura_aplicada['fondos_reparacion'],
                    'fondos_a_nuevo'                    => $cobertura_aplicada['fondos_a_nuevo'],
                    'deducible_aplicado'                => $cobertura_aplicada['deducible_aplicado'],
                ]);
            }

            $liquidacion_administrativa->bienes()->attach($bien['id'], [
                'indemnizacion_reparacion'          => $bien['indemnizacion_reparacion'],
                'indemnizacion_a_nuevo'             => $bien['indemnizacion_a_nuevo'],
                'anos_antiguedad'                   => $bien['anos_antiguedad'],
                'procentage_depreciacion'           => $bien['procentage_depreciacion'],
                'valor_depreciado'                  => $bien['valor_depreciado'],
                'ratio'                             => isset($bien['ratio']) ? $bien['ratio'] : null,
                'deducible_aplicado_a_reparacion'   => isset($bien['deducible_aplicado_a_reparacion']) ? $bien['deducible_aplicado_a_reparacion'] : null,
                'deducible_aplicado_a_nuevo'        => $bien['deducible_aplicado_a_nuevo'],
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
