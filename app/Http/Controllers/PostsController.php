<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
       /* $posts = Post::whereIn('user_id', $users)->with('user')->orderBy('created_at', 'DESC')->get();*/
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
    	return view('posts.create');// posts.create same as posts/create
    }

    public function store()
    {
    	$data = request()->validate([
    		'caption' => 'required',
    		'image' => ['required', 'image'],//or 'required|image'//image is instance of uploaded file class
    	]);

        $imagePath = request('image')->store('uploads'/*path*/, 'public'/*what driver we want to use to store our file.eg:s3(for amazon s3),local storage that is in our public directory*/);

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

    	auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

    	/*\App\Models\Post::create($data);*/

    	return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Models\Post $post)
    {
        /*dd($post);*/

        return view('posts.show', compact('post'/*,'another field'*/)); /*short cut of  return view('posts.show', [
            'post' =>$post,
        ]);*/
    }

}
