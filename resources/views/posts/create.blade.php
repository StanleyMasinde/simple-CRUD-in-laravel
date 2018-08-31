@extends('layouts.app')

@section('content')
    <div class="container card">
        <a href="/posts">Go back</a>
        @if (Route::has('login'))
            @auth
            <b>Add a new Post</b>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="/posts" class="custom-center">
                @csrf <br>
                <label>Title</label> <br>
                <input type="text" class="input" name="title" value="{{ old('title') }}"/> <br>
                <label>Body</body> <br>
                <textarea name="body">{{ old('body') }}</textarea> <br>
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
                    Please <a href="/login">Login</a> or <a href="/register">Sign Up</a> to be able to Post. 
            @endauth
        @endif
    </div>
@endsection