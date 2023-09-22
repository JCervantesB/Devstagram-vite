<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
        $post = Post::where('user_id', $user->id)->latest()->paginate(5);
        
        return view('dashboard', [
            'user' => $user,
            'posts' =>$post
        ]);
    }

    public function create()
    {
      return view('post.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

    Post::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'imagen' => $request->imagen,
        'user_id' => auth()->user()->id
        
    ]);

    return redirect()->route('post.index',auth()->user()->username);
    
    }

    public function show(User $user,Post $post)
    {
        return view('post.show',[
            'post' => $post,
            'user' => $user
        ]);


    }

    public function destroy(Post $post)
    {
      $this->authorize('delete', $post);
      $post->delete();

        $imagen_path = public_path('upload/'.$post->imagen );

        if(File::exists($imagen_path)  ){
            unlink($imagen_path);
        }

         

    return redirect()->route('post.index', auth()->user()->username);


    }





}
