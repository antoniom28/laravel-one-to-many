@extends('layouts.dashboards')

@section('content')
    <?php
        if(isset($_GET['bozze']))
            $menu = false;
        else
            $menu = true;
    ?>

    <div class="text-center d-flex flex-column">
        @if ($menu)
            <h1>
                <a class="d-inline-block" href="/">Torna in home</a>
            </h1>
            <h1>
                <a class="d-inline-block" href="{{route("admin.posts.index" , ["bozze" => true])}}">
                    Vai alle bozze
                </a>
            </h1>
    </div>
            <div class="create">
                <h2><a href="{{route("admin.posts.create")}}">Nuovo Post</a></h2>
            </div>
        @else
            <h1>
                <a class="d-inline-block" href="{{route("admin.posts.index")}}">Torna ai post pubblicati</a>
            </h1>
        @endif
    @foreach ($posts as $post)

    <?php
    if(isset($_GET['bozze']))
        $published = !$post->published;
    else
        $published = $post->published;
    ?>

        @if($published)
            <div class="my-4 card">
                <h1> {{$post->title}} </h1>
            <p> {{$post->content}} </p>
            <p> <strong>Slug</strong>: {{$post->slug}} </p>
            @if($post->category != null)
                <p> Category : {{$post->category->name}} </p> 
            @else
                <p> Category : --- </p>
            @endif
            <span> Creato il : {{$post->created_at}} </span>
            
            
            @if(!$post->published)
                <h1>questo non è pubblico</h1>
            @endif
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