@extends('layouts.backend')
@section("titile", "categories")

@section('content')
<section> 
    <div class="row ml-10 justify-content-center">
        <div class="col-lg-8 bg-white">
            <h2 class="py-3 mb-5 text-center">{{ $category->name }}</h2>
            
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <table class="table">
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <td>Slug</td>
                        <td>:</td>
                        <td>{{ $category->slug }}</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>:</td>
                        <td>{{ $category->category }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>:</td>
                        <td>{{ $category->description }}</td>
                    </tr>
                    <tr>
                        <td>Create Time</td>
                        <td>:</td>
                        <td>{{ $category->created_at }}</td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td>:</td>
                        <td><img class="mt-3" width="100" src="{{ asset('storage/uploads/categories/'.$category->image) }}" alt="{{ $category->name }}"></td>
                    </tr>
                </table>
            </table>

            
        </div>
    </div>
</section>
@endsection


