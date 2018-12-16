@extends('layouts.app') 
@section('content')

<div class="row" style="margin: 0px;">
    <div>
        <h3>
            Notícias
            <a href="{{ route('posts.create') }}" class="btn btn-outline-primary">
                Adicionar
            </a>
        </h3>
    </div>
    <div class="ml-auto">
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</div>
<hr>
    @include('includes.alerts')

<div>
    @forelse ($posts as $post) @php ($pathImage = ($post->image) ? url("storage/tenants/{$post->user->tenant->uuid}/posts/{$post->image}")
    : url("storage/img/default.png")) 
@endphp
    <div class="card" style="margin-bottom: 20px">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item mr-auto">
                    <small class="text-muted">{{ $post->created_at->format('d/m/Y') }} - {{ $post->created_at->format('H:m') }}</small>
                    <strong class="text-success">{{ '@' . $post->user->name }}</strong>
                </li>
                <li class="nav-item ml-auto">
                    <a class="nav-link btn-outline-secondary" href="{{ route('posts.show', $post->id) }}">comentários</a>
                </li>
                @if (auth()->user()->name == "Fabio Jr" || auth()->user()->id == $post->user_id)
                <li class="nav-item">
                    <a class="nav-link btn-outline-primary" href="{{ route('posts.edit', $post->id) }}">Editar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-outline-danger" href="{{ route('posts.show', $post->id) }}">Deletar</a>
                </li>
                @endif
            </ul>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ $pathImage }}" alt="{{ $post->title }}" class="img-circle" style="max-width: 40%">
                </div>
                <div class="col-md-7 off">
                    <strong class="text-primary"><p>{{ $post->title }}</p></strong>
                    <div>{{ $post->body }}</div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="card-body">
        <p>Nenhuma notícia cadastrada!</p>
    </div>
    @endforelse {!! $posts->links() !!}

</div>
@endsection