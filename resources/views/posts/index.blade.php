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
            @php $pathImage = url("storage/img/default.png"); if ($post->image) $pathImage = url("storage/tenants/{$post->user->tenant->uuid}/posts/{$post->image}")
            
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
                <a href="{{ route('posts.show', $post->id) }}"><button class="btn btn-outline-secondary">Detalhes</button></a>
                <a href="{{ route('posts.edit', $post->id) }}"><button class="btn btn-outline-primary">Editar</button></a>
            </div>
        </div>
    </li>
    <hr> @empty
    <li class="media">
        <p>Nenhuma notícia cadastrada!</p>
    </li>
    @endforelse {!! $posts->links() !!}
</ul>
@endsection