<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UsuarioResource;
use App\Models\User;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\compare;

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
    public function getUsuariosPorcentaje($fecha1,$fecha2,$letra): \Illuminate\Http\JsonResponse
    {
        $total_users = Usuarios::all()->count();
        $users = Usuarios::whereBetween('fechaRegistro', [$fecha1, $fecha2])
            ->where('Nombre' ,'like',$letra.'%')
            ->count();
        $porcentaje = ($users*100)/$total_users;
        return response()->json([
            'total_usuarios'=>$total_users,
            'usuarios_filtrados' => $users,
            'porcentaje' => $porcentaje.'%'
        ]);
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
    public function getUsuarioTiempoPromedio($id): \Illuminate\Http\JsonResponse
    {
        $cantidad_juegos = Usuarios::where('usuarios.id',$id)
            ->join('partidas','partidas.idJugador','=','usuarios.id')
            ->select('usuarios.id','usuarios.Nombre','usuarios.Apellido','partidas.idJuego')
            ->count();
        $tiempo_total = Usuarios::where('usuarios.id',$id)
            ->join('partidas','partidas.idJugador','=','usuarios.id')
            ->select(DB::raw("SUM(partidas.fechaFin - partidas.fechaInicio) as tiempo_partida"))
            ->groupBy('usuarios.id','usuarios.Nombre','usuarios.Apellido')
            ->get();
        $tiempo_total = $tiempo_total[0]["tiempo_partida"];
        $promedio = $tiempo_total/$cantidad_juegos;
        return response()->json([
            'total_de juegos'=>$cantidad_juegos,
            'tiempo_total'=>$tiempo_total,
            'promedio' => $promedio
        ]);
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
