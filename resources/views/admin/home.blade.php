@extends('layouts.app')
s
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="post ">
                        @guest
                        <h4 class="text-secondary">Eseguire Login o effettuare una nuova registrazione per interagire</h4>
                        @endguest
                        @auth
                        <a href="{{route("admin.create")}}">New Post</a>
                        @endauth
                        @foreach($posts as $post)
                        <div class="container">

                            <div class="border row">
                                <div class="col">
                                    <h1 class="text-primary">Title: {{$post->title}}</h1>
                                    <h3 class="text-secondary">Content: {{$post->content}}</h3>
                                    <h5> Author: {{ $post->user->name }}</h5>
                                    <p>{{ $post->category ? $post->category->name : 'none' }}</p>

                            </div>

                                @auth
                                <div class="col row d-flex justify-content-around align-items-center">
                                    <div >
                                    <button type="button" class="btn btn-secondary"><a class="text-light" href="{{ route('admin.show', $post->id) }}">Details</a></button>
                                    </div>
                                    <div >
                                    <button type="button" class="btn btn-secondary"><a class="text-light" href="{{ route('admin.edit', $post->id) }}">Edit</a></button>
                                    </div>
                                    
                                    <div >
                                    @include('partials/deleteBtn',["id" => $post->id])
                                    </div>
                                </div>
                                @endauth
                            @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection