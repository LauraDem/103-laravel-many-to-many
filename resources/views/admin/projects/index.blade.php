@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container mt-5">
    <h1>Project list</h1>
    <a href="{{route('admin.projects.create')}}" class="btn btn-outline-primary mt-3"><i class="fa-solid fa-plus"></i> Nuovo progetto</a>
    <hr>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Type</th>
            <th scope="col">Tec</th>
            <th scope="col">Name</th>
            <th scope="col">Published</th>
            <th scope="col">Slug</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
            <tr>
              <th scope="row">{{ $project->id }}</th>
              <td>{!! $project->getTypeBadge() !!}</td>
              <td>{!! $project->getTecBadge() !!}</td>
              <td>{{ $project->name }}</td>
              <td>
                <form method="POST" action="{{ Route('admin.projects.publish', $project) }}" 
                  id="form-published-{{ $project->id }}">
                  @method('PATCH')
                  @csrf

                <label class="switch">
                  <input type="checkbox" name="published" @if ($project->published) checked @endif>
                  <span class="slider round checkbox-published" data-id="{{ $project->id }}"></span>
                </label>
              </form>
              </td>
              <td> {{ $project->slug }} </td>
              <td>{{ $project->created_at }}</td>
              <td>{{ $project->updated_at }}</td>
              <td>
                <a href="{{ route('admin.projects.show', $project) }}"><i class="fa-solid fa-arrow-up-right-from-square text-primary"></i></a>
              </td>
              <td>
                <a href="{{ route('admin.projects.edit', $project) }}"><i class="fa-solid fa-pencil text-warning"></i></a>
              </td>

              <td>
                <a href="javascript:void(0)" class="text-danger"data-bs-toggle="modal"
                data-bs-target="#delete-project-modal-{{ $project->id }}">
                <i class="fa-solid fa-trash"></i>
                </a>
              </td>
            </tr>


            @empty
            <tr>
                <td colspan="6">
                    <i>Non ci sono Progetti!</i>
                </td>
            </tr>
            @endforelse
                
                
        </tbody>
      </table>
    {{ $projects->links('pagination::bootstrap-5') }}
</div>
@endsection

@section('modals')
@foreach ($projects as $project)

<div class="modal fade" id="delete-project-modal-{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Conferma eliminazione</h1>
          <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Vuoi davvero eliminare il progetto <strong>"{{ $project->name }}"</strong> ??
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

        <form method="POST" action={{route('admin.projects.destroy', $project) }}>
            @method('DELETE')
            @csrf

            <button class="btn btn-danger">Elimina</button>  
        </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach
@endsection

@section('scripts')
<script>
  const checkboxesPublished = document.getElementsByClassName('checkbox-published');

  for (checkbox of checkboxesPublished) {
    checkbox.addEventListener('click', function()  {
      const idProject = this.getAttribute('data-id');
      const form = document.getElementById('form-published-' + idProject);
      form.submit();
      
    })
  }
</script>
@endsection
    