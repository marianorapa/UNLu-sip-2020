<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $descripcion
 * @property string $created_at
 * @property string $updated_at
 * @property PersonaTipo[] $personaTipos
 */
class TipoDocumento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tipo_documento';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['descripcion', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function personaTipos()
    {
        return $this->hasMany('App\PersonaTipo');
    }

    public function gettipodocumento(){
        $tipos = TipoDocumento::all();
        foreach($tipos as $tipo){
            $tiposArray[$tipo->id] = $tipo->descripcion;
        }
        return $tiposArray;
    }
}
