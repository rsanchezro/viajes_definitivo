<?php

namespace App;

/** Necesitamos importar el modelo con el que se relaciona
 * este, para poder usar la clave foránea que los une. */
use App\Tour;
use Illuminate\Database\Eloquent\Model;
// Necesitamos el trait SoftDeletes en el modelo
// para poder usar los campos de soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Operator extends Model
{
    /** Como no existe herencia múltiple en PHP,
     * desde dentro de la clase necesitamos referenciar
     * el trait SoftDeletes, que fué importado
     * al comienzo del script. */
    use SoftDeletes;
    /** Recordemos que el nombre de la tabla es opcional si
     * coincide con el plural del modelo. Aún así, lo
     * indicamos por convencionalismo. */
    protected $table = 'operators';
    protected $fillable = [
        'nombre',
        'ciudad',
        'direccion',
        'telefono',
        'rango'
    ];
    /** Los campos a los que queremos asignarles un valor
     * por defecto, si no se establece en la creación. */
    protected $attributes = [
        'rango' => '00',
    ];
    /** La fecha de soft delete, para poder establecerla
     * usando la clase SoftDeletes, se declara en la matriz
     * $dates. */
    protected $dates = [
        'deleted_at'
    ];
    /** El siguiente método, que debe ser siempre público,
     * permite usar la clave foránea declarada en las
     * migrations para relacionar este modelo con el
     * modelo Tour. En el código se usa el método hasMany()
     * que indica que un objeto de este modelo tendrá (o podrá
     * tener) relación con muchos objetos del modelo Tour. */
    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
