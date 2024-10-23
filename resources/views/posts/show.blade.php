@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>{{ $post->name }}</h4>
        <p>{{ $post->title }}</p>
        <p>{{ $post->body }}</p>

        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
    </div>
@endsection
