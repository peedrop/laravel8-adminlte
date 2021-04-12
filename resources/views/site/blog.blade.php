@extends('layouts.site')

@section('title', 'Blog')

@section('content')
    <div class="row mt-4">
        <div class="col-sm-3">
            <h3 class="text-center">Categorias</h3>
            <ul class="list-group">
                @foreach ($categories as $category)
                    <a href="#">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$category->name}}
                            <span class="badge badge-dark badge-pill">{{$category->qntPostsBlog()}}</span>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-9">
            <h3 class="text-center">Posts</h3>
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-sm-6 mb-3">
                        <div class="card border-dark h-100">
                            <img class="card-img-top" src="{{ asset('img/imgDefault.png') }}" alt="Card image cap">
                            <div class="card-body pb-0">
                                <h5 class="card-title mb-2">{{$post->title}}</h5>
                                <h6 class="card-text text-muted">{{$post->subtitle}}</h6>
                                <p class="card-text text-justify" title="{{$post->headline}}">{{ Str::limit($post->headline, 150, $end='...') }}</p>
                            </div>
                            <div class="text-center mb-2">
                                <a href="#" class="btn btn-dark">Ver mais</a>
                            </div>
                            <div class="card-footer text-muted text-center">
                                <img src="{{ asset('img/imgDefault.png') }}" width="15%" class="rounded-circle mr-2" alt="Foto Perfil">
                                {{$post->verifyEdit()}} por {{ $post->user->nameSplit(1) }} em {{ date('d/m/Y', strtotime($post->updated_at)) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center mt-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                      <li class="page-item active"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                      </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
