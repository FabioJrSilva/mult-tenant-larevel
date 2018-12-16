<div class="form-group">
    <input value="{{ $post->title ?? old('title') }}" class="form-control" type="text" name="title" placeholder="Título">
</div>
<div class="form-group">
    <input class="form-control" type="file" name="image">
</div>
<div class="form-group">
    <textarea class="form-control" name="body" cols="20" rows="5" placeholder="Conteúdo">{{ $post->body ?? old('body') }}</textarea>
</div>
<div class="row offset-10">
    <div class="form-control-sm">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('posts.index') }}">Voltar</a>
    </div>
    <div class="form-control-sm">
        <button type="submit" class="btn btn-success btn-sm">Enviar</button>
    </div>
</div>