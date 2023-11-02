@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

<div class="container mt-5">
    <h1>Crea Progetto</h1>
    <a href="{{route('admin.projects.index')}}" class="btn btn-outline-primary mt-3"><i class="fa-solid fa-arrow-left"></i> Torna alla lista</a>
    <hr>

@if($errors->any())
    <div class="alert alert-danger" role="alert">
        correggi:
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{route('admin.projects.store')}}" class="row" enctype="multipart/form-data">
        @method('POST')
        @csrf

        



        <div class="col-12">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


        <div class="col-12">
            <label for="cover_image" class="form-label">Cover image</label>
            <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror" value="{{old('cover_image')}}">
            @error('cover_image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


        
        <div class="col-12 mb-4">
            <label for="type_id" class="form-label">Categoria</label>
            <select name="type_id" id="type_id" class="form-select">
                @foreach ($types as $type)
                    <option value="{{$type->id}}" @if (old('type_id') == $type->id) selcted @endif>{{$type->label}}</option>
                @endforeach
            </select>   
        </div>

        <div class="col-12 mb-4">
            <div class="row @error ('technologies') is-invalid @enderror">

                @foreach ($technologies as $technology)
                <div class="col-2">
                    <input 
                    type="checkbox" 
                    name="technologies[]" 
                    id="technologies-{{$technology->id}}" 
                    value="{{ $technology->id }}" 
                    class="form-check-control"
                     @if (in_array( $technology->id, old('technologies') ?? [])) checked @endif>
                    <label for="technologies-{{$technology->id}}">{{ $technology->label }}</label>
                </div>
                @endforeach

            </div>
        </div>



        <div class="col-12">
            <label for="content" class="form-label">Contenuto</label>
            <textarea type="text" name="content" id="content" class="form-control @error('content') is-invalid @enderror " rows="5">{{old('content')}}</textarea>
            @error('content')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="col-12 mb-4">
            <button class="btn btn-success mt-3"><i class="fa-solid fa-floppy-disk"></i> Salva</button>
        </div>
    </form>

</div>


@endsection