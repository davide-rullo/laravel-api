@extends('layouts.admin')

@section('content')
<div class="container pt-4">
    <h3>Hello {{ Auth::user()->name}}!</h3>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('admin.projects.index')}}">
                        <h4><i class="fa-solid fa-diagram-project "></i>
                            Projects</h4>
                    </a>
                    <h3>{{$total_projects}}</h3>

                </div>
            </div>
        </div>
        <div class="col-4">
        </div>
        <div class="col-4">
        </div>
    </div>
</div>
@endsection