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
                    <div class="d-flex justify-content-center avatar">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset("storage/".Auth::user()->avatar) }}" alt="">
                        @else
                                <form action="{{route("admin.users.update" , Auth::user())}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                <div class="form-group">
                                    <label for="avatar">Image</label>
                                    <input type="file" name="avatar" class="p-1 form-control @error('avatar') is-invalid @enderror ">
                                </div>
                                @error('avatar')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror

                                <button type="submit" class="btn btn-primary">
                                    Vai
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="text-center">
                        <u>{{ Auth::user()->name }}</u>
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
