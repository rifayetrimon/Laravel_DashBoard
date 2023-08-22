@extends('layouts.backend')
@section("titile", "posts")

@section('content')
<section> 
    <div class="row ml-10 justify-content-center">
        <div class="col-lg-6 bg-white">
            <h2 class="py-3 mb-5 text-center">Edit Post</h2>
            
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route("post.update", "$post->id") }}" 
                method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Post Id</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Post" name="name" value="{{ $post->category_id }}">
                    <div class="fv-plugins-message-container invalid-feedback">
                    </div>
                </div>

                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Titile</span>
                    </label>
                    <input type="text" class="form-control form-control-solid" placeholder="Enter Post" name="name" value="{{ $post->title }}">
                    <div class="fv-plugins-message-container invalid-feedback">
                    </div>
                </div>

                
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Slug</span>
                    </label>
                    <input type="text" class="form-control form-control-solid" placeholder="Enter Post" name="name" value="{{ $post->slug }}">
                    <div class="fv-plugins-message-container invalid-feedback">
                    </div>
                </div>
            
                
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Status</span>
                    </label>
                    <input type="text" class="form-control form-control-solid" placeholder="Enter Post" name="name" value="{{ $post->status }}">
                    <div class="fv-plugins-message-container invalid-feedback">
                    </div>
                </div>

                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Post Image</span>
                    </label>
                    <!--end::Label-->
                    <input type="file" class="form-control" name="image" placeholder="Enter Category" name="image">
                    <p>Image size 300*300 </p>
                    <img class="mt-3" width="100" src="{{ asset('storage/uploads/posts/'.$post->thumbnail) }}" alt="{{ $post->id }}">
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>

                <div class="text-center">
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-success">
                        <span class="indicator-label">Update</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection


