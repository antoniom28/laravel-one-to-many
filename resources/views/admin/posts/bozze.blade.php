@extends('layouts.dashboards')

@section('content')
    <a href="/">
        <h1>TURN TO HOME</h1>
    </a>
    @foreach ($posts as $post)
        @if($post->published)
            <div class="my-4 card">
                <h1> {{$post->title}} </h1>
            <p> {{$post->content}} </p>
            <p> <strong>Slug</strong>: {{$post->slug}} </p>
            <span> Creato il : {{$post->created_at}} </span>
            <br><br>

            <div>
                <a href="{{route('admin.posts.show' , $post->id)}}">
                    VISUALIZZA
                </a>
            </div>
            <div>
                <a href="{{route('admin.posts.edit' , $post->id)}}">
                    MODIFICA
                </a>
            </div>

    
            <form class="confirm-delete" method="POST" action="{{route('admin.posts.destroy' , $post->id)}}">
                @csrf
                @method("DELETE")

                <div class="button-choice">
                    <a href="">
                        <button class="p-0 yes-btn" type="submit" value="cancella">CANCELLA</button>
                    </a>
                </div>
            </form> 
            </div>
        @endif
    @endforeach
@endsection