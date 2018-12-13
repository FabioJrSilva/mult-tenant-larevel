@extends('layouts.app') 
@section('content')

<h1><b class="text-primary">{{ $post->title }}</b></h1>

@php $pathImage = ($post->image) ? url("storage/tenants/{$post->user->tenant->uuid}/posts/{$post->image}") : url('storage/img/default.png');

@endphp

<form action="{{ route('posts.destroy', $post->id) }}" method="post">
    @csrf
    <div class="container form-control-lg" style="margin-top: 10px">
        <div class="row">
            <span class="text-muted pull-right">
                <small class="text-muted">{{ $post->created_at->format('d/m/Y') }}</small>
            </span>
            <strong class="text-success">{{ '@' . $post->user->name }}</strong>
        </div>
        <div class="form-group" style="margin-top: 10px">
            <div class="img-circle">
                @if ($pathImage == url('storage/img/default.png'))
                <img src="{{ $pathImage }}" alt="{{ $post->title }}" class="img-circle" style="max-height: 80%;"> @else
                <img src="{{ $pathImage }}" alt="{{ $post->title }}" class="img-circle" style="max-width: 80%;"> @endif
            </div>
        </div>
        <div class="form-group">
            <pre class=" form-group">{{ $post->body }}</pre>
        </div>
        <div class="row">
            <div class="form-control-sm">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('posts.index') }}">Voltar</a>
            </div>
            @if (auth()->user()->name == "Fabio Jr" || auth()->user()->id == $post->user_id)
            <div class="form-control-sm">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
            </div>
            @endif
        </div>
    </div>
</form>
@endsection