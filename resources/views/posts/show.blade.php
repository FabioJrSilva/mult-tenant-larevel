@extends('layouts.app') 
@section('content')

<h1><b class="text-primary">{{ $post->title }}</b></h1>

@php $pathImage = ($post->image) ? url("storage/tenants/{$post->user->tenant->uuid}/posts/{$post->image}") : url('storage/img/default.png');

@endphp
    @include('includes.alerts')

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

        <div class="form-group row">
            <div class="form-control-sm">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('posts.index') }}">Voltar</a>
            </div>
            @if (auth()->user()->name == "Fabio Jr" || auth()->user()->id == $post->user_id)
            <div class="form-control-sm">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
            </div>
            @endif
            <!-- Button trigger modal comments-create -->
            <div class="form-control-sm">
                <button type="button" class=" btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#comment">
                    Comentar
                </button>
            </div>
        </div>
        @if ($post->comments->count())
        <h4>Comentários</h4>

        <table class="table">
            <thead>
                <tr>
                    <th>Comentários</th>
                    <th>Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($post->comments as $comment)
                <tr>
                    <td>{{ $comment->comment}}</td>
                    <td>{{ $comment->user->name}}</td>
                    <td>
                        @if (auth()->user()->id == $post->user_id)
                        <div>
                            <!-- Button trigger modal comments-delete -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#comment-delete">
                            Deletar
                        </button>
                        </div>

                        @else -- @endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div>
            <p> -- Sem Comentários --</p>
        </div>
        @endif
    </div>
</form>

<!-- Modal Cooments - Create -->
<div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="commentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentLabel">Comentário:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('comments.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="modal-body">
                    <textarea name="comment" id="" cols="43" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">cancelar</button>
                    <button type="submit" class="btn btn-outline-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Comments - Delete -->

<div class="modal fade" id="comment-delete" tabindex="-1" role="dialog" aria-labelledby="commentLabel-delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentLabel-delete"> Deletar comentário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            @if ($post->comments->count())
            <form action="{{ route('comments.destroy',$comment->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="_method" value="delete">
                <div class="modal-body">
                    <textarea name="comment" id="" cols="43" rows="3">{{ $comment->comment }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-danger">Deletar</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection