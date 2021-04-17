@extends('layouts.site')

@section('title', 'Blog')

@section('content')
    <div class="row mt-4">
        <div class="col-sm-3">
            <h3 class="text-center">Pesquisar</h3>
            <form action="{{ route('blog.search', request()->category->id ?? '') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" value="{{request()->search}}" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <h3 class="text-center">Categorias</h3>
            <ul class="list-group">
                <li class="list-group-item">
                    <select name="category_id" class="form-control select2" id="category_id" value="{{ request()->category->id ?? '' }}" required>
                        <option></option>
                        @foreach ($categories_all as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </li>
                @foreach ($categories as $category)
                    <a href="{{ route('blog.search', $category->id) }}">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$category->name}}
                            <span class="badge badge-dark badge-pill">{{$category->qntPostsBlog()}}</span>
                        </li>
                    </a>
                @endforeach
                <small><i>*top 3 categorias</i></small>
            </ul>
            <h3 class="text-center mt-4">Arquivos</h3>
            <div class="timeline text-center">
                @foreach ($months as $month)
                    <div class="time-label">
                        <a href="#">
                            <span class="badge p-2 m-0 bg-primary"><i class="far fa-folder"></i> {{$month}}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-sm-9">
            <h3 class="text-center">Posts</h3>
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-sm-6 mb-3">
                        <div class="card border-dark h-100">
                            <img class="card-img-top" src="{{ asset('storage/img/posts/' . $post->image_path) }}" alt="Imagem capa do blog">
                            <div class="card-body pb-0">
                                <h5 class="card-title mb-2">{{$post->title}}</h5>
                                <h6 class="card-text text-muted">{{$post->subtitle}} <span class="badge badge-secondary">{{$post->category->name}}</span></h6>
                                <p class="card-text text-justify" title="{{$post->headline}}">{{ Str::limit($post->headline, 150, $end='...') }}</p>
                            </div>
                            <div class="text-center mb-2">
                                <a href="{{route('post', $post->id)}}" class="btn btn-dark">Ler mais</a>
                            </div>
                            <div class="card-footer text-muted text-center">
                                <img src="{{ asset('storage/img/profile/' . $post->user->profile_path) }}" width="10%" class="img-circle mr-2" alt="Foto Perfil">
                                {{$post->verifyEdit()}} por {{ $post->user->nameSplit(1) }} em {{ date('d/m/Y', strtotime($post->updated_at)) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
@endsection
