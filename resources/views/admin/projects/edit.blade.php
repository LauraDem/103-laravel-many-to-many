@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

<div class="container mt-5">
    <h1>Modifica Progetto</h1>
    <a href="{{route('admin.projects.index')}}" class="btn btn-outline-primary mt-3"><i class="fa-solid fa-arrow-left"></i> Torna alla lista</a>
    <a href="{{route('admin.projects.show', $project)}}" class="btn btn-outline-primary mt-3"><i class="fa-solid fa-arrow-up-right-from-square"></i> Vedi dettagli</a>
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

    <form method="POST" action="{{route('admin.projects.update', $project)}}" class="row">
        @method('PATCH')
        @csrf



        <div class="col-12">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $project->name }}" >
        </div>

           
        <div class="col-12">
            <label for="type_id" class="form-label">Categoria</label>
            <select name="type_id" id="type_id" class="form-select">
                <option value="">Nessun Tipo</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if (old('type_id') ?? $project->type_id == $type->id) selected @endif> {{$type->label}}</option>
                @endforeach
            </select>     
        </div>


        <div class="col-12">
            <label for="content" class="form-label">Contenuto</label>
            <textarea type="text" name="content" id="content" class="form-control" rows="5">{{ old('content') ?? $project->content }}</textarea>
        </div>
        
        <div class="col-12 mb-4">
            <button class="btn btn-success mt-3">
                <i class="fa-solid fa-floppy-disk"></i>
                Salva
            </button>
        </div>
    </form>

</div>


@endsection