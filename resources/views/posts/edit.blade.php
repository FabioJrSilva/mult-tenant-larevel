@extends('layouts.app')

@section('content')

<h1>Editar Post</h1>

@include('includes.alerts')

<form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">

    @include('posts._partials.form')
</form>

@endsection
