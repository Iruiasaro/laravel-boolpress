@extends('layouts.app')

@section('content')
@include("partials.errorsAlert")

<div class="container">

<a href="{{ route('admin.index') }}">Torna alla home</a>
    <form action="{{ route('admin.store') }}" method="post">
        @csrf



        <label for="title">Title</label>
        <input type="text" name="title" id="title">

        <label for="content">Text Description</label>
        <input type="text" name="content" id="content">

        <div class="form-group">
            <label>Category</label>
            <select name="category_id"
                class="form-control  @error('category_id') is-invalid @enderror" >
                <option value="">-- seleziona categoria --</option>
                    @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == old('category_id', '') ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

            <div class="form-control">
            @foreach($tags as $tag)
            <label for=""></label>
            <input type="checkbox" name="tags[]" value="{{$tag->id}}">
            {{$tag->name}}
            </label>
                
            @endforeach
            </div>


                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        <input type="submit" value="Send">
    </form>
    {{-- <script src={{asset('js/app.js')}}></script> --}}
</div>
@endsection

