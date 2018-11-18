@extends('layouts.app')

@section('content')
    <div class="container" >
        <h1 >Posts</h1>

        @forelse ($posts as $post)
            <h3>Título: {{ $post->title }}
                <a href="{{ route('posts.edit', $post->id) }}"><button class="btn btn-outline-success">Editar</button></a>
            </h3>
            <hr>
            <p>Descrição: {{ $post->body }}</p>
            <hr>
        @empty
            <p>Nenhum Post...</p>
        @endforelse

    </div>
@endsection
