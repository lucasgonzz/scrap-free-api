<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            /*
            |--------------------------------------------------------------------------
            | insurer_id
            |--------------------------------------------------------------------------
            |
            | Hace referencia a la aseguradora
            | Enlaza el siniestro con el id de los registros de la tabla "Insurers" (aseguradoras)
            | Se llama mediante el metodo "aseguradora" definido en la clase "App\Models\Claim"
            |
            */
            // $table->integer('insurer_id')->nullable()->unsigned();
            $table->foreignId('insurer_id')->nullable()->constrained();
            $table->string('nro_siniestro')->nullable();
            $table->string('orden_servicio')->nullable();
            $table->string('referencia_poliza')->nullable();
            $table->string('poliza')->nullable();
            $table->string('asociado')->nullable();
            $table->string('ramo')->nullable();
            /*
            |--------------------------------------------------------------------------
            | product_id
            |--------------------------------------------------------------------------
            |
            | Hace referencia al producto
            | Enlaza el siniestro con el id de los registros de la tabla "Productos" (productos)
            | Se llama mediante el metodo "producto" definido en la clase "App\Models\Claim"
            |
            */
            $table->foreignId('product_id')->nullable()->constrained();
            // Deducibles 
            $table->decimal('cobertura_1', 12,2)->nullable();
            $table->decimal('deducible_1', 12,2)->nullable();
            $table->decimal('cobertura_2', 12,2)->nullable();
            $table->decimal('deducible_2', 12,2)->nullable();
            $table->decimal('cobertura_3', 12,2)->nullable();
            $table->decimal('deducible_3', 12,2)->nullable();
            /*
            |--------------------------------------------------------------------------
            | cause_id
            |--------------------------------------------------------------------------
            |
            | Hace referencia a la causa del siniestro
            | Enlaza el siniestro con el id de los registros de la tabla "Caueses" (causas)
            | Se llama mediante el metodo "causa" definido en la clase "App\Models\Claim"
            |
            */
            $table->foreignId('cause_id')->nullable()->constrained();
            /*
            |--------------------------------------------------------------------------
            | scrap_free_manager_id
            |--------------------------------------------------------------------------
            |
            | Hace referencia al gestor de scrap free del siniestro
            | Enlaza el siniestro con el id de los registros de la tabla "ScrapFreeManagers" (gestores scrap free)
            | Se llama mediante el metodo "gestor_scrap_free" definido en la clase "App\Models\Claim"
            |
            */
            $table->foreignId('scrap_free_manager_id')->nullable()->constrained();
            /*
            |--------------------------------------------------------------------------
            | insurer_manager_id
            |--------------------------------------------------------------------------
            |
            | Hace referencia al gestor de la aseguradora del siniestro
            | Enlaza el siniestro con el id de los registros de la tabla "InsurerManagers" (gestores aseguradora)
            | Se llama mediante el metodo "gestor_aseguradora" definido en la clase "App\Models\Claim"
            |
            */
            $table->foreignId('insurer_manager_id')->nullable()->constrained();
            $table->string('titular_poliza')->nullable();
            $table->enum('tipo_documento', ['DNI', 'CI', 'LE'])->nullable();
            $table->string('nro_documento')->nullable();
            $table->timestamp('fecha_ocurrencia')->nullable();
            $table->timestamp('fecha_denuncia')->nullable();
            $table->timestamp('fecha_alta_scrap_free')->nullable(); 
            $table->timestamp('fecha_cierre_scrap_free')->nullable();

            /*
            |--------------------------------------------------------------------------
            | CONTADORES
            |--------------------------------------------------------------------------
            |
            | Hay que definir esto
            |
            */

            $table->text('recomendacion')->nullable();
            /*
            |--------------------------------------------------------------------------
            | service_order_type_id
            |--------------------------------------------------------------------------
            |
            | Hace referencia al tipo orden servicio del siniestro
            | Enlaza el siniestro con el id de los registros de la tabla "ServiceOrderTypes" (tipo orden servicios)
            | Se llama mediante el metodo "tipo_orden_servicio" definido en la clase "App\Models\Claim"
            |
            */
            $table->foreignId('service_order_type_id')->nullable()->constrained();
            $table->text('comentarios_seguro')->nullable();
            /*
            |--------------------------------------------------------------------------
            | line_id
            |--------------------------------------------------------------------------
            |
            | Hace referencia a la linea del equipo del siniestro
            | Enlaza el siniestro con el id de los registros de la tabla "Lines" (lineas)
            | Se llama mediante el metodo "linea" definido en la clase "App\Models\Claim"
            |
            */
            $table->foreignId('line_id')->nullable()->constrained();
            $table->text('descripcion_bien')->nullable();
            /*
            |--------------------------------------------------------------------------
            | repair_center_id
            |--------------------------------------------------------------------------
            |
            | Hace referencia al centro de reparacion del siniestro
            | Enlaza el siniestro con el id de los registros de la tabla "RepairCenters" (centros de reparacion)
            | Se llama mediante el metodo "centro_reparacion" definido en la clase "App\Models\Claim"
            |
            */
            $table->foreignId('repair_center_id')->nullable()->constrained();
            /*
            |--------------------------------------------------------------------------
            | transporte_retiro_id
            |--------------------------------------------------------------------------
            |
            | Hace referencia al transporte de retiro del siniestro
            | Enlaza el siniestro con el id de los registros de la tabla "Transports" (transportes)
            | Se llama mediante el metodo "transporte_retiro" definido en la clase "App\Models\Claim"
            |
            */
            $table->foreignId('transporte_retiro_id')->nullable()->constrained('transports');
            $table->string('denunciante')->nullable();
            $table->string('telefono_contacto')->nullable();
            $table->string('telefono_alternativo')->nullable();
            $table->string('email_alternativo')->nullable();
            /*
            |--------------------------------------------------------------------------
            | location_id
            |--------------------------------------------------------------------------
            |
            | Hace referencia a la localidad del siniestro
            | Enlaza el siniestro con el id de los registros de la tabla "Locations" (localidades)
            | Se llama mediante el metodo "localidad" definido en la clase "App\Models\Claim"
            |
            | A su vez, las Localidades pertenecen a una Provincia,
            | por lo que desde el metodo $siniestro->lodalidad se puede acceder a la provincia:
            | $siniestro->localidad->provincia
            |
            */
            $table->foreignId('location_id')->nullable()->constrained();
            $table->text('domicilio')->nullable();
            $table->text('entre_calles')->nullable();
            $table->text('domicilio_retiro')->nullable();
            // domicilio_devolucion se tendria que omitir?
            $table->text('domicilio_devolucion')->nullable();
            // Aca iria "estado_siniestro" que se omite en la linea 125
            $table->text('nota_domicilio')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->text('accesorios')->nullable();

            // La columna "quien_embala" hace referencia al transporte como la columna "Transporte"? Esto habilitaria que se pueda seleccionar dentro de los transportistas ingresados en el sistema. 
            $table->text('quien_embala')->nullable();

            $table->timestamp('fecha_alta_retiro')->nullable();
            $table->timestamp('fecha_agenda_retiro')->nullable();
            $table->timestamp('fecha_agenda_entrega')->nullable();
            $table->timestamp('fecha_retiro')->nullable();
            $table->timestamp('fecha_recibido')->nullable();
            $table->timestamp('fecha_estimada_devolucion')->nullable();
            /*
            |--------------------------------------------------------------------------
            | Fotos
            |--------------------------------------------------------------------------
            |
            | Se guardan solo las URL
            |
            */
            $table->text('url_foto_evidencia')->nullable();
            $table->text('url_foto_frente')->nullable();
            $table->text('url_foto_atras')->nullable();
            $table->timestamp('fecha_combra_fabricacion')->nullable();

            $table->decimal('van', 12,2)->nullable();
            /*
            |--------------------------------------------------------------------------
            | transport_devolucion_id
            |--------------------------------------------------------------------------
            |
            | Hace referencia al transporte de retiro del siniestro
            | Enlaza el siniestro con el id de los registros de la tabla "Transports" (transportes)
            | Se llama mediante el metodo "transporte_devolucion" definido en la clase "App\Models\Claim"
            |
            */
            $table->foreignId('transport_devolucion_id')->nullable()->constrained('transports');
            $table->timestamp('fecha_reporte')->nullable();
            $table->timestamp('fecha_cierre_administrativo')->nullable();
            $table->timestamp('fecha_confirmacion_sancor')->nullable();
            $table->timestamp('fecha_reparacion')->nullable();
            $table->timestamp('fecha_alta_transporte_devolucion')->nullable();
            $table->timestamp('fecha_retiro_para_devolucion')->nullable();
            $table->timestamp('fecha_devolucion')->nullable();

            $table->text('notas_scrap_free')->nullable();
            $table->text('notas_transporte')->nullable();

            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            // Aca comito el campo "Pantalla (libre)"
            $table->string('numero_seria')->nullable();
            $table->text('url_foto_frente_2')->nullable();
            $table->text('url_foto_atras_2')->nullable();
            // Si aca son mas de una foto se crearia una relacion "otras fotos"
            $table->text('url_otras_fotos')->nullable();
            $table->text('url_foto_frente_tecnico')->nullable();
            $table->text('url_foto_atras_tecnico')->nullable();
            $table->text('cometarios_tecnico')->nullable();
            /*
            |--------------------------------------------------------------------------
            | technical_id
            |--------------------------------------------------------------------------
            |
            | Hace referencia al tecnico del siniestro
            | Enlaza el siniestro con el id de los registros de la tabla "Technicals" (tecnicos)
            | Se llama mediante el metodo "tecnico" definido en la clase "App\Models\Claim"
            |
            */
            $table->foreignId('technical_id')->nullable()->constrained();
            $table->text('posible_causa')->nullable();
            $table->text('url_foto_informe_tecnico')->nullable();
            $table->text('url_foto_evidencia_tecnico')->nullable();
            $table->text('url_foto_presupuesto_tecnico')->nullable();
            $table->text('url_foto_factura_tecnico')->nullable();
            $table->text('url_foto_factura_compra')->nullable();
            $table->text('url_foto_deposito_deducible')->nullable();
            // Aca se omite campo FotoBenchmark1
            
            // Aca se podrian armar unas relaciones
            $table->decimal('gestion_life', 12,2)->nullable();
            $table->decimal('gestion_sancor', 12,2)->nullable();
            
            $table->decimal('costo_flete_ida', 12,2)->nullable();
            // ¿Aca no deberia ser "costo_flete_vuelta", eso dice en el excel Campos?
            $table->decimal('costo_reporte', 12,2)->nullable();

            // ContScrapFree
            $table->decimal('reparacion_paga_asegurado', 12,2)->nullable();
            $table->decimal('costo_flete_vuelta', 12,2)->nullable();
            $table->decimal('flete_otros_costos', 12,2)->nullable();
            $table->decimal('pagado_tecnico', 12,2)->nullable();
            $table->decimal('liquidacion_siniestro', 12,2)->nullable();
            $table->decimal('liquidacion_deducible', 12,2)->nullable();
            $table->decimal('reparacion_siniestro', 12,2)->nullable();
            $table->decimal('reparacion_deducible', 12,2)->nullable();
            $table->boolean('control')->default(1);
            $table->boolean('base')->default(1);
            $table->boolean('cable')->default(1);
            $table->boolean('cargador')->default(1);
            
            /*
            |--------------------------------------------------------------------------
            | timestamps
            |--------------------------------------------------------------------------
            |
            | Aca se crean los campos:
            | created_at: hace referencia a cuando se crea el registro en la tabla
            | updated_at: hace referencia a cuando se actualiza el registro en la tabla
            |
            */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claims');
    }
}
