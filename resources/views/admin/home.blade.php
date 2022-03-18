@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex flex-column align-items-center justify-content-center avatar">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset("storage/".Auth::user()->avatar) }}" alt="">
                        @else
                            <h1>CARICA UN AVATAR</h1>    
                        @endif
                    </div>
                    <div class="mt-4 text-center">
                        <u>{{ Auth::user()->name }}</u>
                        {{ __('You are logged in!') }}
                    </div>
                </div>
                
            </div>
            <form action="{{route("admin.users.update" , Auth::user())}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="d-flex form-group">
                <input type="file" name="avatar" class="w-70 p-1 form-control @error('avatar') is-invalid @enderror ">
                <button type="submit" class="w-30 btn btn-primary">
                    Cambia Avatar
                </button>
            </div>
            @error('avatar')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror

            
        </form>
        </div>
    </div>
</div>
@endsection
