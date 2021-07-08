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

                    <input type="file" name="postCover" accept=".jpg,.png" class="form-control-life">
                    
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            <label>Tags</label><br>

            @foreach($tags as $tag)

            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input name="tags[]" class="form-check-input" type="checkbox" value="{{ $tag->id }}" {{ $post->tags->contains($tag) ? 'checked' : '' }}>
                    {{ $tag->name }}
                </label>
            </div>

            @endforeach

    <input type="submit" value="Save">

        </div>
          
</form>

<script src={{asset('js/app.js')}}></script>
</div>
@endsection