<?php

namespace App;

use App\Operator;
use App\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    use SoftDeletes;
    protected $table = 'tours';
    protected $fillable = [
        'operator_id',
        'destino',
        'inicio_fecha',
        'inicio_hora',
        'final_fecha',
        'final_hora',
        'precio',
        'duracion',
        'detalles'
    ];
    protected $dates = [
        'deleted_at'
    ];

    /** El siguiente método relaciona este modelo con Operator
     * mediante la clave foránea que se definió en la migration.
     * Observa que, esta vez, el nombre del método va en singular,
     * porque cada objeto Tour sólo pertenecerá a un objeto de
     * la clase Operator. El hecho de que los objetos Tour
     * pertenezcan a un objeto Operator se indica mediante el
     * uso del método belongsTo(). */
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    /** El siguiente método sirve para relacionar los objetos
     * de este modelo con los del modelo Customer. Como un
     * objeto Tour puede relacionarse con muchos objetos del
     * modelo Customer, el nombre de este método está en
     * plural.
     * El uso del método belongsToMany() ya indica que la
     * relación es de tipo n-m. */
    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}
