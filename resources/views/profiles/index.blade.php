@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <!-- <img src="/png/logo.png" class="rounded-circle pt-5 pl-5 pr-5" style="max-height: 27vh;background-color:black;" > -->
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
             <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{ $user->username }}</div>  
                    
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
             </div>

            @can('update', $user->profile)      
                 <a href="/p/create">Add New Post</a>
            @endcan
            </div>

            @can('update', $user->profile)
                 <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
               <!--  <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pr-5"><strong>{{ $user->profile->followers->count() }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $user->following->count() }}</strong> following</div> -->
                <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>

            </div>
            <!-- <div class="pt-4 font-weight-bold">WishComeTrue.org</div>
            <div>World is a beautiful place. We have to take care of this place to hand it over to future generation.Stay calm Stay happy.Take care of your loved ones.</div>
            <div><a href="#">www.WishComeTrue.org</a></div> -->

            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url ?? 'N/A' }}</a></div>

        </div>
    </div>

    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> -->
    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{ $post->id }}">
                <img src="/storage/{{ $post->image }}" class="w-100">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
