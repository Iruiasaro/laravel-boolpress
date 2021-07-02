@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{ route('admin.index') }}">Home Page</a>

<ul>

    <li>ID: {{ $post->id }}</li>
    <li>TITLE: {{ $post->title }}</li>
    <li>CONTENT: {{ $post->content }}</li>
    <li>USER: {{ $user->name }}</li>
    <li>CREATED: {{ $post->created_at }}</li>
    <li>LAST EDIT: {{ $post->updated_at }}</li>
    <p>{{ $post->category ? $post->category->name : 'none' }}</p>


    <div class="col row d-flex align-items-center">
        <div>
            <button type="button" class="btn btn-primary"><a class="text-light" href="{{ route('admin.edit', $post->id) }}">Edit</a></button>
        </div>
       
        <div>
            @include('partials/deleteBtn',["id" => $post->id])
        </div>
    </div>
</ul>
<script src={{asset('js/app.js')}}></script>
</div>
@endsection