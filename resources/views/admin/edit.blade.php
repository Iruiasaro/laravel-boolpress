@extends('layouts.app')

@section('content')
@include("partials.errorsAlert")
<div class="container">

<a href="{{ route('admin.index') }}">Home Page</a>
<form action="{{ route('admin.update', $post->id) }}" method="post">
    @csrf

    @method('PATCH')

    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="{{ $post->title}}">

    <label for="content">content</label>
    <input type="content" name="content" id="content" value="{{ $post->content }}">

    <div class="form-group">
                    <label>Categoria</label>
                    <select name="category_id"
                            class="form-control  @error('category_id') is-invalid @enderror" >
                        <option value="">-- seleziona categoria --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                        {{ $category->name }} 
                    </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


    <input type="submit" value="Save">
</form>

<script src={{asset('js/app.js')}}></script>
</div>
@endsection