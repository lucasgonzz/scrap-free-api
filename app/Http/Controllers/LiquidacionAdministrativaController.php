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
        // Log::info('attachBienes:');
        // Log::info($bienes);
        foreach ($bienes as $bien) {
            Log::info('Se agrego bien '.$bien['nombre']);
            if ($bien['posicion_en_liquidacion'] != 0 || $bien['posicion_en_liquidacion'] == '') {
                $store_bien = Bien::find($bien['id']);
                $coberturas_aplicadas = array_reverse($bien['coberturas_aplicadas']);
                foreach ($coberturas_aplicadas as $cobertura_aplicada) {
                    $store_bien->coberturas_aplicadas()->attach($cobertura_aplicada['id'], [
                        'remanente_a_cubrir'                => $cobertura_aplicada['remanente_a_cubrir'], 
                        'deducible'                         => $cobertura_aplicada['deducible'],
                        'fondos'                            => $cobertura_aplicada['fondos'],
                        'deducible_aplicado'                => isset($cobertura_aplicada['deducible_aplicado']) ? $cobertura_aplicada['deducible_aplicado'] : null,
                    ]);
                }

                $liquidacion_administrativa->bienes()->attach($bien['id'], [
                    // 'indemnizacion'                     => $bien['indemnizacion_bien'],
                    'anos_antiguedad'                   => $bien['anos_antiguedad'],
                    'procentage_depreciacion'           => $bien['procentage_depreciacion'],
                    'valor_depreciado'                  => $bien['valor_depreciado'],
                    'ratio'                             => isset($bien['ratio']) && is_numeric($bien['ratio']) ? $bien['ratio'] : null,
                    
                    'reparacion_con_deducible'          => isset($bien['reparacion_con_deducible']) && is_numeric($bien['reparacion_con_deducible']) ? $bien['reparacion_con_deducible'] : null,
                    
                    'deducible_aplicado_a_reparacion'   => isset($bien['deducible_aplicado_a_reparacion']) && is_numeric($bien['deducible_aplicado_a_reparacion']) ? $bien['deducible_aplicado_a_reparacion'] : null,
                    
                    // 'deducible_aplicado'                => $bien['deducible_aplicado'],
                ]);

                $store_bien->indemnizacion_a_nuevo = $bien['indemnizacion_a_nuevo'];
                $store_bien->deducible_aplicado_a_indemnizacion = $bien['deducible_aplicado_a_indemnizacion'];

                if (isset($bien['deducible_aplicado_a_reparacion'])) {
                    $store_bien->indemnizacion_reparacion = $bien['indemnizacion_reparacion'];
                    $store_bien->deducible_aplicado_a_reparacion = $bien['deducible_aplicado_a_reparacion'];
                }

                $store_bien->save();

                // Log::info('Se le puso el bien '.$bien['nombre']);
            } else {
                Log::info('No se va a usar el bien '.$bien['nombre'].', posicion_en_liquidacion: '.$bien['posicion_en_liquidacion']);
            }
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
