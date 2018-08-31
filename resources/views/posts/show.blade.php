@extends('layouts.app')

@section('content')
    <div class="container card">
        <a href="/">Back</a>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="card-body">
            <b>{{ $posts->title }}</b> <br>
            <b>By</b>
            <small>{{ $author->name }}</small> <br>
               {{ $posts->body }}
               <small>Created at{{ $posts->created_at }}</small>
               <small>Updated at{{ $posts->updated_at }}</small>
               <br>
               Comments {{ $count }} <br>
               @can('update', $posts)
                   <form method="POST">
                        <a href="/posts/{{ $posts->id }}/edit">Edit</a>
                       @method('DELETE') 
                       @csrf
                       <input type="hidden" value="{{ $posts->id }}">
                   <button class="btn btn-sm btn-danger">Delete</button>
                   </form>
               @endcan
        </div>
    </div>
    <div class="container">
        <div class="card-body container">
            @auth
            <form method="POST" action="/comments">
                @csrf
            <input type="hidden" value="{{ $posts->id }}" name="id" />
            <input type="text" class="" placeholder="enter your comment" name="comment" /> &nbsp;
            <button class="btn btn-sm btn-success" type="submit">Comment</button>
            </form>
            @endauth
            @guest
                <div class="alert alert-warning">Please login to be able to be able to comment on this post</div>
            @endguest
            @foreach ($comments as $comment)
                <div class="card container comment"><b>{{ $comment->user->name }}</b>{{ $comment->body }}</div>
            @can('comment', $comment)
                this is the the post
            @endcan
            @endforeach
        </div>
    </div>
@endsection