<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UsuarioResource;
use App\Models\User;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsuariosPartidas($acepto): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $users = Usuarios::where('usuarios.Acepto',$acepto)
            ->join('partidas','partidas.idJugador','=','usuarios.id')
            ->select('usuarios.id','usuarios.Nombre','usuarios.Apellido',DB::raw("COUNT(partidas.idJuego) as total_partidas"))
            ->groupBy('usuarios.id','usuarios.Nombre','usuarios.Apellido')
            ->orderByDesc('total_partidas')
            ->take(10)
            ->get();
        return UsuarioResource::collection($users);
    }
    public function getUsuariosMasGanadores($disfraz): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $users = Usuarios::where('usuarios.idDisfraz',$disfraz)
            ->join('partidas','partidas.idJugador','=','usuarios.id')
            ->select('usuarios.id','usuarios.Nombre','usuarios.Apellido',DB::raw("SUM(partidas.puntos) as total_puntos"))
            ->groupBy('usuarios.id','usuarios.Nombre','usuarios.Apellido')
            ->orderByDesc('total_puntos')
            ->take(10)
            ->get();
        return UsuarioResource::collection($users);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuarios $usuarios)
    {
        //
    }
}
