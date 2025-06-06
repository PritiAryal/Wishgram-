<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;


class ProfilesController extends Controller
{
     //
  /*   public function index($user)
    {
    	$user = User::findOrFail($user);

        return view('profiles.index', [
        	'user' => $user,
        ]);
    }*/
        public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'count.posts.' . $user->id,
             now()->addSeconds(30),
             function () use ($user) {
                return $user->posts->count();
        });//$user->posts->count();
//remember,rememberforever
        //adddays,addmonths...
        $followersCount = Cache::remember( 
            'count.followers.' . $user->id,
             now()->addSeconds(30),
             function () use ($user) {
                return $user->profile->followers->count();
        });//$user->profile->followers->count();
        $followingCount = Cache::remember(
            'count.following.' . $user->id,
             now()->addSeconds(30),
             function () use ($user) {
                return $user->following->count();
        });//$user->following->count();
        //dd($follows);

    	return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
    	$this->authorize('update', $user->profile);
    	
    	return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
    	$data = request()->validate([
    		'title' => 'required',
    		'description' => 'required',
    		'url' => 'url',
    		'image' => '',
    	]);


        if(request('image')) /*if request has image*/{
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }


        auth()->user()->profile->update(array_merge(
        $data,
        $imageArray ?? []
        ));

    	return redirect("/profile/{$user->id}");
    }
}