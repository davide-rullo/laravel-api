@extends('layouts.admin')

@section('content')

@if (session('message'))
<div class="alert alert-success alert-dismissible fade show pt-5" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>Message: </strong>{{session('message')}}
</div>
@endif





<h1 class="pt-5 pb-3">Projects</h1>

<a href="{{route('admin.projects.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add new project</a>


<table class="table table-primary">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Github Link</th>
            <th scope="col">Actions</th>

        </tr>
    </thead>
    <tbody>

        @forelse ($projects as $project)
        <tr class="">
            <td scope="row">{{$project->id}}</td>


            <td>
                @if ($project->cover_image)
                <img width="100" src="{{asset('storage/' . $project->cover_image)}}">
                @else
                N/A
                @endif
            </td>
            <td>{{$project->title}}</td>
            <td><a class="card-link pe-3" href="{{$project->github_link}}" target=”_blank”><i class="fa-brands fa-square-github fa-lg"></i></a>
                <a class="card-link" href="{{$project->online_link}}" target=”_blank”><i class="fa-solid fa-globe"></i></a>
            </td>


            <td> <a class="btn btn-primary btn-sm" href="{{route('admin.projects.show', $project)}}"><i class="fa-solid fa-eye"></i></a>
                <a class="btn btn-secondary btn-sm" href="{{route('admin.projects.edit', $project)}}"><i class="fa-solid fa-file-pen"></i></a>





                <!-- Modal trigger button -->
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-{{$project->id}}">
                    <i class="fa-solid fa-trash-can"></i>
                </button>

                <!-- Modal Body -->
                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                <div class="modal fade" id="delete-{{$project->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$project->id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId-{{$project->id}}">{{$project->title}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                This action will cancel permanently your project. Are you sure ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                <form action="{{route('admin.projects.destroy', $project)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>










            </td>

        </tr>

        @empty
        <tr class="">
            <td scope="row">No projects yet!</td>
        </tr>
        @endforelse

        {{$projects->links('pagination::bootstrap-5')}}

    </tbody>
</table>

</div>



@endsection