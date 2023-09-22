<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    // protege la ruta, es decir si no esta logueado no puede acceder
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        $request->request->add(['username' => Str::slug($request->username)  ]);
    
      $this->validate($request, [
            'username' => ['required','unique:users,username,' .auth()->user()->id ,'min:3','max:20'],
      ]);

      if($request->imagen){
      
        $imagen = $request->file('imagen');

        $nombreImgen = Str::uuid() . "." . $imagen->extension();

        $imgServidor = Image::make($imagen);
        $imgServidor->fit(1000, 1000);

        $imgPath = public_path('perfiles') . '/' . $nombreImgen;
        $imgServidor->save($imgPath);
  
      }
      //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImgen ?? auth()->user()->imagen ?? null;
        $usuario->save();

       return redirect()->route('post.index',$usuario->username);
    }
}
