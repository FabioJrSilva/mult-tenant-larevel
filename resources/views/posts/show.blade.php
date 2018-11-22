@extends('layouts.app')

@section('content')

<h1>Detalhes do post <b>{{ $post->title }}</b></h1>

@php
$pathImage = ($post->image) ? url("storage/tenants/{$post->user->tenant->uuid}/posts/{$post->image}") : url('imgs/posts/default.png');
@endphp
<img src="{{ $pathImage }}" alt="{{ $post->title }}">

<p>{{ $post->body }}</p>

<form action="{{ route('posts.destroy', $post->id) }}" method="post">
    @csrf

    <input type="hidden" name="_method" value="DELETE">

    <button type="submit" class="btn btn-danger">Deletar</button>
</form>

@endsection
