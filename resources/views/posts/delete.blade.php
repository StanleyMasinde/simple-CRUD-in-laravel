@extends('layouts.app')

@section('content')
<div class="container card">
    <a href="/posts">Go back</a>
    <b>Edit Post</b>
    <form method="POST" action="/posts/{{ $post->id }}" class="custom-center">
        @csrf <br>
        @method('DELETE')
        <label>Title</label> <br>
        <input type="text" class="input" name="title" value="{{ $post->title }}"/> <br>
        <label>Body</body> <br>
        <textarea name="body">{{ $post->body }}</textarea> <br>
        <button class="btn btn-success">Post</button>
        @if ( $errors->any() )
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
            @endforeach
        @endif
    </form>
</div>
@endsection