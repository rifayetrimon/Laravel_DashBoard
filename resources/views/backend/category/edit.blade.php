@extends('layouts.backend')
@section("titile", "categories")

@section('content')
<section> 
    <div class="row ml-10 justify-content-center">
        <div class="col-lg-6 bg-white">
            <h2 class="py-3 mb-5 text-center">Edit Category</h2>
            
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route("category.update", "$category->id") }}" 
                method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Category Name</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Category" name="name" value="{{ $category->name }}">
                    <div class="fv-plugins-message-container invalid-feedback">
                    </div>
                </div>
                
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-12 fv-row">
                        <label class="fs-6 fw-bold mb-2">Parent Category</label>
                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" name="parent_id">
                            <option disabled selected>Select Parent Category</option>

                            {{-- @foreach ($categories as singleCategory)
                            <option value="{{ $singleCategory->id }}" {{ ($category->parentCategory->name ?? null) == ($singleCategory->name ? "selected" : '') }}>{{ $singleCategory->name }}</option>
                            @endforeach --}}
                            
                        </select>
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>                 
                </div>
                <div class="d-flex flex-column mb-8">
                    <label class="fs-6 fw-bold mb-2">Descripton</label>
                    <textarea class="form-control" rows="3" name="description" placeholder="Type Target Details"> {{ $category->description }}</textarea>
                </div>

                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Category Image</span>
                    </label>
                    <!--end::Label-->
                    <input type="file" class="form-control" name="image" placeholder="Enter Category" name="image">
                    <p>Image size 300*300 </p>
                    <img class="mt-3" width="100" src="{{ asset('storage/uploads/categories/'.$category->image) }}" alt="{{ $category->name }}">
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


