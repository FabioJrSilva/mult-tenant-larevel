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
    <div>
        <a class="btn btn-outline-secondary" href="{{ route('posts.index') }}">Voltar</a>
        <button type="submit" class="btn btn-outline-success">Enviar</button>
    </div>
</div>