<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
    // Autorización
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){

        if (request()->ajax()) {
            return datatables()->of(User::latest()->get())
                ->addColumn('action', function ($data) {
                    $button = '<a style="cursor:pointer"
                    name="edit" id="' . $data->id . '"
                    class="edit 
                    "><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> ';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a style="cursor:pointer"
                    name="delete" id="' . $data->id . '"
                    class="delete 
                    "><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('user.usuarios');
    }

    public function store(Request $request){
        /* Se hace la validacion de los comapos del formulario */
        $rules = array(
            'role'           => 'required|string|max:20',
            'name'          => 'required|string|max:100',
            'surname'       => 'required|string|max:200',
            'num_empleado'  => 'required|int',
            'nick'          => 'required|string|max:100',
            'email'         => 'required|string|email|max:255',
            'password'      => 'required|string|max:255',
            'image'         => 'default.jpg'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image="default.png";
        $form_data = array(
            'role'           => $request->role,
            'name'          => $request->name,
            'surname'       => $request->surname,
            'num_empleado'  => $request->num_empleado,
            'nick'          => $request->nick,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'image'         => $image
        );

        User::create($form_data);

        return response()->json(['success' => 'Usuario insertado correctamente.']);
    }

    public function edit($id){
        if (request()->ajax()) {
            $data = User::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function updateAdmin(Request $request)
    {
        /* Se hace la validacion de los comapos del formulario */
        $rules = array(
            'role'           => 'required|string|max:20',
            'name'          => 'required|string|max:100',
            'surname'       => 'required|string|max:200',
            'num_empleado'  => 'required|int',
            'nick'          => 'required|string|max:100',
            'email'         => 'required|string|email|max:255',
            'password'      => 'string|min:6',
            'image'         => 'string|max:255'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image = "default.png";
        $form_data = array(
            'role'          => $request->role,
            'name'          => $request->name,
            'surname'       => $request->surname,
            'num_empleado'  => $request->num_empleado,
            'nick'          => $request->nick,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'image'         => $image
        );

        User::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Usuario actualizado correctamente.']);
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
    }

    //Vista a configuración
    public function config(){
        return view('user.config');
    }

    public function update(Request $request) {
        // Conseguir usuario identificado
        $user = \Auth::user();
        $id = $user->id;

        // Validacion del formulario
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        // Recojer los datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        // Subir la imagen
        $image_path = $request->file('image_path');
        if ($image_path) {
            // Poner nombre unico
            $image_path_name = time() . $image_path->getClientOriginalName();

            // Guardar en la carpeta storage (Storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            // Seteo el nombre de l imagen en el objeto
            $user->image = $image_path_name;
        }

        // Asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        // Ejecutar consulta y cambios a la base de datos
        $user->update();

        return redirect()->route('config')
                        ->with(['message' => 'Usuario actualizado correctamente']);
    }

    public function getImage($filename) {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
}
