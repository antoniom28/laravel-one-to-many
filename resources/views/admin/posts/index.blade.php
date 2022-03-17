@extends('layouts.dashboards')

@section('content')
    <?php
        if(isset($_GET['bozze']))
            $menu = false;
        else
            $menu = true;
            if(isset($_GET['category_id'])){
                $filter_category = $_GET['category_id'];
                if(is_numeric($filter_category ))
                    if($filter_category >=0 && $filter_category < count($categories))
                        true;
                    else
                        $filter_category = null;
                    else
                        $filter_category = null;
            }
            else
                $filter_category = null;
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
            <div class="mt-3 create">
                <h2 class="mt-0"><a href="{{route("admin.posts.create")}}">Nuovo Post</a></h2>
                <form class="filter d-flex" action="">
                    <div class="form-group m-0 mr-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="category_id">Categoria</label>
                            </div>
                            <select class="custom-select" id="category_id" name="category_id">
                              <option value="{{null}}">scegli..</option>
                              @foreach ($categories as $key => $category)
                                <option value="{{$key}}" {{(old("category_id") == $category->id) ? "selected" : ""}}>{{$category->name}}</option>
                              @endforeach
                            </select>
                          </div>
                    </div>
            
                    <button type="submit" class="btn btn-primary">Filtra</button>
                </form>
            </div>
        @else
            <h1>
                <a class="d-inline-block" href="{{route("admin.posts.index")}}">Torna ai post pubblicati</a>
            </h1>
        @endif
        
    
    

    @foreach ($filter_category != null ? $categories[$filter_category]->posts : $posts as $post)

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