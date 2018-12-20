@extends('layouts.app') 
@section('content') @php $pathImage = ($post->image) ? url("storage/tenants/{$post->user->tenant->uuid}/posts/{$post->image}")
: url('storage/img/default.png'); 
@endphp
    @include('includes.alerts')
<form action="{{ route('posts.destroy', $post->id) }}" method="post">

    <div class="card" style="margin-bottom: 20px">
        <div class="card-header">
            <ul class="nav">
                <li class="mr-auto">
                    <small class="text-muted">{{ $post->created_at->format('d/m/Y') }} - {{ $post->created_at->format('H:m') }}</small>
                    <strong class="text-success">{{ '@' . $post->user->name }}</strong>
                </li>
                <li class="ml-auto">
                    <a>
                        <button type="button" class=" btn btn-outline-primary" data-toggle="modal" data-target="#comment">
                            Comentar
                        </button>
                    </a>
                    <a class="btn btn-outline-secondary" href="{{ route('posts.index') }}">Voltar</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ $pathImage }}" alt="{{ $post->title }}" class="img-circle" style="max-width: 40%">
                </div>
                <div class="col-md-7 off">
                    <strong class="text-primary"><p>{{ $post->title }}</p></strong>
                    <div>{{ $post->body }}</div>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if ($post->comments->count())

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
                            @if (auth()->user()->name == "Fabio Jr" || auth()->user()->id == $comment->user_id)
                            <div>
                                <!-- Button trigger modal comments-update -->
                                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#comment-update">
                                    Editar
                                </button>

                                <!-- Button trigger modal comments-delete -->
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#comment-delete">
                                    Deletar
                                </button>
                            </div>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="text-center">
                <p> -- Sem Comentários --</p>
            </div>
            @endif
        </div>
    </div>
</form>

<!-- Modal Comments - Create -->
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

<!-- Modal Comments - Update -->

<div class="modal fade" id="comment-update" tabindex="-1" role="dialog" aria-labelledby="commentLabel-update" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentLabel-update"> Editar comentário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            @if ($post->comments->count())
            <form action="{{ route('comments.update',$comment->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="_method" value="put">
                <div class="modal-body">
                    <textarea name="comment" id="" cols="43" rows="3">{{ $comment->comment }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-primary">Editar</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection