@extends('layouts.app') 
@section('content')

<h1>Editar Notícia</h1>
    @include('includes.alerts')

<form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="_method" value="PUT">
    @include('posts._partials.form')
</form>
@endsection