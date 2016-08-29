<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreUsuariosRequest;
use App\Http\Requests\UpdateUsuariosRequest;
use App\Http\Controllers\Controller;
use App\User;
use Session;

class UsuariosController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('admin.usuarios.index',['users' => $users]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsuariosRequest $request)
    {
        $user = User::create($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        Session::flash('mensaje-success','El usuario '.$user->nombre. ' se ha creado con éxito');
        return redirect('/admin/usuarios');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return response()->json([
                'id'       => $user->id,
                'nombre'   => $user->nombre,
                'apellido' => $user->apellido,
                'email'    => $user->email,
                'perfil'   => $user->perfil
            ]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsuariosRequest $request)
    {

        $user = User::find($request->id);
        $user->fill($request->all());
        $user->save();
        Session::flash('mensaje-success','El usuario '.$user->nombre. ' se ha modificado con éxito');
        return redirect('/admin/usuarios');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('mensaje-success','El usuario '.$user->nombre. ' se ha eliminado con éxito');
        return redirect('/admin/usuarios');
    }
}
