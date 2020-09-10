<?php

namespace App\Http\Controllers;

use App\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OperatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** Determinamos criterios que pueden venir por la petición */
        // El estado: activos, inactivos, todos.
        $estado = (isset($request['estado']))?$request['estado']:'T';
        // El rango, con hasta dos límites, para buscar mayores que,
        // menores que, entre, iguales a o distintos de
        $rangoLimite1 = (isset($request['rangoLimite1']))?$request['rangoLimite1']:'00';
        $rangoLimite2 = (isset($request['rangoLimite2']))?$request['rangoLimite2']:'10';
        // Para buscar que el nombre o la ciudad contenga una sub cadena
        $busqueda = (isset($request['busqueda']))?$request['busqueda']:'';
        $dondeBuscar = (isset($request['dondeBuscar']))?$request['dondeBuscar']:'';
        // El criterio de ordenación. Por defecto, será el nombre
        $criterioDeOrden = (isset($request['criterioDeOrden']))?$request['criterioDeOrden']:'nombre';
        // El sentido de ordenación. Por defecto será asc (ascendente)
        $sentidoDeOrden = (isset($request['sentidoDeOrden']))?$request['sentidoDeOrden']:'ASC';
        // El numero de resultados
        $numeroDeResultados = (isset($request['numeroDeResultados']))?$request['numeroDeResultados']:5;
        // El número de página
        $pageNumber = (isset($request['pageNumber']))?$request['pageNumber']:1;


        // Creamos la consulta según los requisitos solicitados
        $operatorsQuery = DB::table('operators');
        // Por estado
        if ($estado == 'A') // Activos
        {
            $operatorsQuery->whereNull('deleted_at');
        } elseif ($estado == 'I') {// Inactivos
            $operatorsQuery->whereNotNull('deleted_at');
        } // Todos es el comportamiento por defecto.
        // Por rango
        $operatorsQuery->where('rango', '>=', $rangoLimite1);
        $operatorsQuery->where('rango', '<=', $rangoLimite2);
        // Por nombre
        if ($dondeBuscar == 'N')
        {
            $operatorsQuery->where('nombre', 'like', '%'.$busqueda.'%');
        }
        // Por ciudad
        if ($dondeBuscar == 'C')
        {
            $operatorsQuery->where('ciudad', 'like', '%'.$busqueda.'%');
        }
        // Ordenación
        $operatorsQuery->orderBy($criterioDeOrden, $sentidoDeOrden);
        /**
         * Calculo del total de rsultados posibles. Si no hay
         * páginas para sefvir la página pedida (p.e. se pidio pag 3 y solo hay 2)
         * se pone el número de página a 1.
         */
        $totalDeResultadosPosibles = count($operatorsQuery->get());
        if ($numeroDeResultados == 0) {
            $resultadosABuscar = $totalDeResultadosPosibles;
            $pageNumber = 1;
        } else {
            $resultadosABuscar = $numeroDeResultados;
            $maxPage = ceil($totalDeResultadosPosibles/$resultadosABuscar);
            if ($pageNumber > $maxPage)
            {
                $pageNumber = $maxPage;
            }
        }

        $operatorsList = $operatorsQuery->paginate($resultadosABuscar, ['*'], 'pageNumber', $pageNumber);

        // Se llama a la vista de la lista de operadores,
        // pasándole la colección y los parámetros de consulta
        // obtenidos en la última llamada.
        return view('operators.list')
            ->with([
                'operatorsList' => $operatorsList,
                'estado' => $estado,
                'rangoLimite1' => $rangoLimite1,
                'rangoLimite2' => $rangoLimite2,
                'busqueda' => $busqueda,
                'dondeBuscar' => $dondeBuscar,
                'criterioDeOrden' => $criterioDeOrden,
                'sentidoDeOrden' => $sentidoDeOrden,
                'numeroDeResultados' => $numeroDeResultados,
                'pageNumber' => $pageNumber
            ]);
    }

    /**
     * Cambio del estado de un operado
     */
    public function changeState(Request $request)
    {
        if ($request['chst_id'] != null)
        {
            $operator = Operator::withTrashed()->find($request['chst_id']);
            if ($operator != null)
            {
                if ($operator->trashed())
                {
                    $operator->restore();
                } else {
                    $operator->delete();
                }
            }
        }
        return redirect()->route('operatorsList');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operators.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verificamos que se han tecleado los campos obligatorios,
        // y no excedan la longitud máxima.
        $reglas = [
            'nombre' => 'required|max:60',
            'ciudad' => ['required', 'max:60', Rule::unique('operators')->where(function ($query) use ($request){
                        return $query->where('rango', $request["rango"]);
            })],
            'direccion' => 'required|max:255',
            'telefono' => 'required||max:255',
            'rango' => 'required|gte:00|lte:10'
        ];

        $messages = [
            'ciudad.unique' => "La combinación de ciudad y rango ya existe."
        ];

        $request->validate($reglas, $messages);

        // Ya se puede crear el objeto
        $nuevoOperador = new Operator;
        $nuevoOperador->nombre = $request['nombre'];
        $nuevoOperador->ciudad = $request['ciudad'];
        $nuevoOperador->direccion = $request['direccion'];
        $nuevoOperador->telefono = $request['telefono'];
        $nuevoOperador->rango = $request['rango'];
        // Persistimos el objeto en la base de datos
        $nuevoOperador->save();

        // Pasamos a una vista que informa de que se ha grabado el artículo
        return view('operators.created')
            ->with([
                'operador'=>$request['nombre']
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $operador = Operator::withTrashed()->findOrFail(request('show_id'));

        return view('operators.show')
            ->with(['datos'=>$operador]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operador = Operator::withTrashed()->findOrFail($id);

        return view('operators.edit')
            ->with(['datos'=>$operador]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $reglas = [
            'nombre' => 'required|max:60',
            'ciudad' => ['required', 'max:60', Rule::unique('operators')->where(function ($query) use ($request){
                        return $query->where('rango', $request["rango"]);
            })->ignore($request->id, 'id')],
            'direccion' => 'required|max:255',
            'telefono' => 'required||max:255',
            'rango' => 'required|gte:00|lte:10'
        ];

        $messages = [
            'ciudad.unique' => "La combinación de ciudad y rango ya existe."
        ];

        $request->validate($reglas, $messages);

        $cambio = Operator::withTrashed()->find($request->id);
        $cambio->nombre = $request->nombre;
        $cambio->ciudad = $request->ciudad;
        $cambio->direccion = $request->direccion;
        $cambio->telefono = $request->telefono;
        $cambio->rango = $request->rango;
        $cambio->save();

        return view('operators.updated')
            ->with([
                'nombre'=>$cambio->nombre
            ]);
    }
}
