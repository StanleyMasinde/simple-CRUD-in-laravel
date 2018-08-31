@extends('layouts.app')

@section('content')
       <div class="card-header">  <h3>Posts</h3> </div>
       <a href="/posts/create">Create New</a>
       @if (session('status'))
           <div class="alert alert-danger">
               {{ session('status') }}
           </div>
       @endif
    @foreach ($new_posts as $item)
    <div class="container card">
        <h3>{{ $item->title }}</h3>
     <b>By</b> <small>{{ $item->user->name }} </small>
    <a href="/posts/{{ $item->id }}">Read</a>
    </div>
    @endforeach
    {{ $new_posts->links() }}
@endsection