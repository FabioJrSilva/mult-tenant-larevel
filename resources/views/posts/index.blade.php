@extends('layouts.app')

@section('content')
    <div class="container" >
        <h1 >Posts</h1>

        @forelse ($posts as $post)
            <p>{{ $post->title }}</p>
            <hr>
        @empty
            <p>Nenhum Post...</p>
        @endforelse

    </div>
@endsection
