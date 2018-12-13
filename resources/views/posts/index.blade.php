@extends('layouts.app') 
@section('content')

<h1 class="text-center">
    Notícias
    <a href="{{ route('posts.create') }}" class="btn btn-outline-primary">
        <i class="fas fa-plus-square"> Adicionar </i>
    </a>
</h1>
<hr>
    @include('includes.alerts')

<ul class="media-list">
    @forelse($posts as $post)
    <li class="media">
        <div class="pull-left">
            @php $pathImage = ($post->image) ? url("storage/tenants/{$post->user->tenant->uuid}/posts/{$post->image}") : url("storage/img/default.png")
            
@endphp
        </div>
        <div class="media-body">
            <div>
                <span class="text-muted pull-right">
                    <small class="text-muted">{{ $post->created_at->format('d/m/Y') }}</small>
                </span>
                <strong class="text-success">{{ '@' . $post->user->name }}</strong>
            </div>
            <div>
                <strong class="text-primary"><p>{{ $post->title }}</p></strong>
                <img src="{{ $pathImage }}" alt="{{ $post->title }}" class="img-circle" style="max-width: 80px; margin: 10px;">
            </div>
            <div class="row">
                <div class="form-control-sm">
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('posts.show', $post->id) }}">Detalhes</a>
                </div>
                @if (auth()->user()->name == "Fabio Jr" || auth()->user()->id == $post->user_id)
                <div class="form-control-sm">
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('posts.edit', $post->id) }}">Editar</a>
                </div>
                <div class="form-control-sm">
                    <a class="btn btn-outline-danger btn-sm" href="{{ route('posts.show', $post->id) }}">Deletar
                    </a>
                </div>
                @endif
            </div>
        </div>
    </li>
    <hr> @empty
    <li class="media ">
        <p>Nenhuma notícia cadastrada!</p>
    </li>
    @endforelse {!! $posts->links() !!}
</ul>
@endsection