@extends('layouts.backend')
@section("titile", "All Post")

@section('content')

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <section>
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <thead>
                <tr class="fw-bolder text-muted">
                    <th>Id</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Category</th>
                    <th>Create Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            <img width="80" src="{{ asset('storage/uploads/posts/'. $post->thumbnail) }}" alt="{{ $post->title }}">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->status }}</td>
                        <td>
                            <a href="{{ route('post.edit', $post->id) }}" class="badge badge-light-warning fs-7 fw-bold">Edit</a>
                            
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

@endsection