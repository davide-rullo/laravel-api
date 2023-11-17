@extends('layouts.admin')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-6 d-flex justify-content-center">
            <div class="card" style="width: 100%;">
                @if (str_contains($project->thumb, 'http'))
                <img class="img-fluid" style="" src="{{$project->cover_image}}">
                @else
                <img class="img-fluid" width="" src="{{asset('storage/' . $project->cover_image)}}">
                @endif
                <div class="card-body d-flex flex-column align-items-center gap-3">
                    <a class="btn btn-secondary btn-sm card-btn" href="{{route('admin.projects.edit', $project)}}">Edit <i class="fa-solid fa-file-pen"></i></a>
                    <h3>{{$project->title}}</h3>
                    <p>Type: {{$project->type ? $project->type->name : 'Uncategorized'}}</p>

                    <div class="d-flex gap-2">
                        <p>Technologies: </p>
                        <ul class="d-flex gap-2 list-unstyled">
                            @forelse ($project->technologies as $technology)

                            <li class="badge bg-primary">
                                {{$technology->name}}

                            </li>
                            @empty
                            <li class="badge bg-secondary">Untagged</li>
                            @endforelse




                        </ul>
                    </div>



                    <p>Description: {{$project->description}}</p>
                    <div class="links">
                        <a class="card-link" href="{{$project->github_link}}" target=”_blank”><i class="fa-brands fa-square-github fa-lg"></i></a>
                        <a class="card-link" href="{{$project->online_link}}" target=”_blank”><i class="fa-solid fa-globe"></i></a>
                    </div>




                </div>
            </div>

        </div>
    </div>
</div>
@endsection