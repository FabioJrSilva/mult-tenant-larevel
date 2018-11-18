@extends('layouts.app')

@section('content')
    <div class="container" >
        <h1 >Posts</h1>

        @forelse ($posts as $post)
            <h3>Título: {{ $post->title }}</h3>
            <p>Descrição: {{ $post->body }}</p>
            <hr>
        @empty
            <p>Nenhum Post...</p>
        @endforelse

    </div>
@endsection
