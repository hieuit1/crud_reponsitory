@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Posts</h1>
        
        <div class="d-flex align-items-center mb-3">
      
             <a href="{{ route('posts.create') }}" class="btn btn-primary  "style="margin-right: 600px;">Create Post</a>
     
            <form action="{{ route('posts.index') }}" method="GET" class="mb-0" style="flex-grow: 1;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search posts by name..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        
           
        </div>
        
         
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->name }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->body }}</td>
                   
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
