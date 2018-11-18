@extends('layouts.app')

@section('content')
    <div class="container" >
        <h1>Cadastrar Post</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="post">
            @csrf

            <div class="form-group">
                <input class="form-control" type="text" name="title" placeholder="Título">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="body" cols="30" rows="5" placeholder="Descrição"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Salvar</button>
            </div>
        </form>

    </div>
@endsection
