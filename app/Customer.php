<?php

namespace App;

use App\Tour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $table = 'customers';
    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'tarjeta_tipo',
        'tarjeta_num',
        'tarjeta_exp',
        'tarjeta_ccv'
    ];
    protected $dates = [
        'deleted_at'
    ];

    /** El siguiente método establece las relaciones entre
     * los objetos de este modelo, y los del modelo Tour.
     * Como un mismo objeto Customer puede estar relacionado
     * con muchos objetos Tour, el nombre del método se expresa
     * en plural. En su interior usamos el método belongsToMany()
     * para indicar que cada objeto Customer pertenece (o
     * puede pertenecer) a varios objetos Tour.
     */
    public function tours()
    {
        $this->belongsToMany(Tour::class);
    }
}
