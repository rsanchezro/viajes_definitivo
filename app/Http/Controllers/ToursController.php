<?php

namespace App\Http\Controllers;

use App\Tour;
use App\Operator;
use App\Customer;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request['trop_id'] == null)
        {
            $tours = Tour::withTrashed()->get();
        } else {
            $tours = Operator::withTrashed()->find($request['trop_id'])->tours;
        }
        return view('tours.list')
            ->with(['viajes'=>$tours]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operadores = Operator::withTrashed()
            ->orderBy('nombre', 'ASC')
            ->get();
        $tiemposPorDefecto = [
            'fInicioDef' => date('Y-m-d'),
            'fFinalDef' => date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d')))),
            'hInicioDef' => date('H:i'),
            'hFinalDef' => date('H:i', strtotime('+1 hour', strtotime(date('H:i'))))
        ];

        return view('tours.new')
            ->with([
                'operadores'=>$operadores,
                'tiempos'=>$tiemposPorDefecto
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'destino' => 'required|max:100',
            'precio' => 'required|gte:1',
            'operador' => 'required|gt:"00"|exists:operators,id'
        ];

        $messages = [
            'destino.required' => 'El destino tiene que establecerse.',
            'destino.max' => 'El destino tendrá un máximo de 100 caracteres.',
            'precio.required' => 'El precio debe estar indicado.',
            'precio.gte' => 'El viaje no puede ser gratis.',
            'operador.required' => 'Debe indicar el operador responsable de este viaje.',
            'operador.gt' => 'Debe indicar el operador responsable de este viaje.',
            'operador.exists' => 'El operador elegido no existe.'
        ];

        $request->validate($reglas, $messages);

        $nuevoViaje = new Tour;
        $nuevoViaje['operator_id'] = $request['operador'];
        $nuevoViaje['destino'] = $request['destino'];
        $nuevoViaje['inicio_fecha'] = $request['inicio-fecha'];
        $nuevoViaje['inicio_hora'] = $request['inicio-hora'];
        $nuevoViaje['final_fecha'] = $request['final-fecha'];
        $nuevoViaje['final_hora'] = $request['final-hora'];
        $nuevoViaje['duracion'] = $request['duracion'];
        $nuevoViaje['precio'] = $request['precio'];
        $nuevoViaje['detalles'] = $request['detalles'];
        $nuevoViaje->save();

        return view('tours.created')
            ->with([
                'destino'=>$request['destino']
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $viaje = Tour::withTrashed()->findOrFail($id);
        /* Ajustamos formatos de fechas y horas */
        $viaje->inicio_fecha = date("Y-m-d", strtotime($viaje->inicio_fecha));
        $viaje->final_fecha = date("Y-m-d", strtotime($viaje->final_fecha));
        $viaje->inicio_hora = date("H:i", strtotime($viaje->inicio_hora));
        $viaje->final_hora = date("H:i", strtotime($viaje->final_hora));
        $operadores = Operator::withTrashed()->get();

        return view('tours.edit')
            ->with([
                'viaje'=>$viaje,
                'operadores'=>$operadores
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $reglas = [
            'destino' => 'required|max:100',
            'precio' => 'required|gte:1',
            'operador' => 'exists:operators,id'
        ];

        $messages = [
            'destino.required' => 'El destino tiene que establecerse. Si no desea cambiarlo, deje el que aparece por defecto.',
            'destino.max' => 'El destino tendrá un máximo de 100 caracteres.',
            'precio.required' => 'El precio debe estar indicado.',
            'precio.gte' => 'El viaje no puede ser gratis.',
            'operador.exists' => 'El operador elegido no existe.'
        ];

        $request->validate($reglas, $messages);

        $cambio = Tour::withTrashed()->find($request->id);
        $cambio->operator_id = $request['operador'];
        $cambio->destino = $request['destino'];
        $cambio->inicio_fecha = $request['inicio-fecha'];
        $cambio->inicio_hora = $request['inicio-hora'];
        $cambio->final_fecha = $request['final-fecha'];
        $cambio->final_hora = $request['final-hora'];
        $cambio->duracion = $request['duracion'];
        $cambio->precio = $request['precio'];
        $cambio->detalles = $request['detalles'];
        $cambio->save();

        return view('tours.updated')
            ->with([
                'destino'=>$cambio->destino
            ]);
    }

    public function tourCustomers($id)
    {
        $viaje = Tour::withTrashed()->findOrFail($id);
        $clientesAsociados = $viaje->customers;
    // marcando clientes:
        $clientes = Customer::orderBy('nombre')
                        ->get()
                        ->map(function ($cliente) use ($clientesAsociados) {
                            $cliente->selected = $clientesAsociados->contains('id', $cliente->id);
                            return $cliente;
                        });

        return view('tours.customers-list')
                ->with([
                    'viaje'=>$viaje,
                    'clientes'=>$clientes
                ]);
    }

    public function setCustomers(Request $request)
    {
        $viaje = Tour::find($request->viaje);
        $viaje->customers()->detach();
        $viaje->customers()->attach($request->clientes);

        return view ('tours.assoc-customers-updated')
            ->with([
                'viaje'=>$viaje->destino
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        //
    }
}
