@extends('layouts.guest')

@section('content')
  <section class="container mt-5">
    <h1>{{ $title }}</h1>

    <div class="row g-3">

    @forelse ($projects as $project)
    <div class="col-3">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between align-items-center">{{ $project->name }} {!! $project->getTypeBadge() !!}</div>
          <div class="card-body">
            {{ $project->getAbstract(150) }}
          </div>
      </div>
    </div>

    
    @empty
    <div class="col_12">
      <h2>non ci sono progetti</h2>
    </div>
    
    @endforelse
  </div>

    {{ $projects->links('pagination::bootstrap-5') }}

  </section>
@endsection
