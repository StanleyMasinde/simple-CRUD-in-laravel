@extends('layouts.app')

@section('content')
<div class="container card">
        <a href="/posts">Go back</a>
        <b>Edit Post</b>
    @if (Route::has('login'))

    @if (Auth::user()->id==$post->user_id)
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <form method="POST" action="/posts/{{ $post->id }}" class="custom-center">
        @csrf <br>
        @method('PUT')
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
    @else
                <div class="alert alert-warning">You dont't have permission to view this page or the link my have been
                    broken. please <a href="/">Go home</a>
                </div>
    @endif
            
@endif
        
    </div>
@endsection