@extends('layouts.backend')
@section("titile", "Add post")

@section('content')
<section> 
    <div class="row ml-10 justify-content-center">
        <div class="col-lg-12 bg-white">
            <h2 class="py-3 mb-5 text-center">Add Post</h2>
            
            @if (session('message'))
            {{ session('message') }}
                <div class="alert alert-success">
                </div>
            @endif

            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route("post.store") }}" 
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Title</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" value="{{ old('title') }}" placeholder="Enter Category" name="title">
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>
                
                <!--end::Input group-->
                <!--begin::Input group-->

                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-12 fv-row">
                        <label class="fs-6 fw-bold mb-2">Category</label>
                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-11-btgu" style="width: 100%;">
                            <span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-team_assign-12-container" aria-controls="select2-team_assign-12-container">
                                <span class="select2-selection__rendered" id="select2-team_assign-12-container" role="textbox" aria-readonly="true" title="Select a Team Member">
                                    <span class="select2-selection__placeholder">Select a Parent Category</span>
                                </span>
                                <span class="select2-selection__arrow" role="presentation">
                                    <b role="presentation"></b>
                                </span>
                            </span>
                        </span>
                        <span class="dropdown-wrapper" aria-hidden="true"></span>
                    </span>
                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" name="category">
                            <option value="">Sports</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror                
                </div>

                {{-- <div class="row g-9 mb-8">
                    <div class="col-md-12 fv-row fv-plugins-icon-container">
                        <label for="fs-6 fw-bold mb-2">Category</label>
                        <select class="form-select select2-hidden-accessible" data-control="select-2" name="category">
                            <option disabled selected>Select Parent Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="fv-plugins-message-contaier invalid-feedback">

                        </div>
                    </div>
                </div> --}}

                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-12 fv-row">
                        <label class="fs-6 fw-bold mb-2">Status</label>
                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" name="status">
                            <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-11-btgu" style="width: 100%;">
                                <span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-team_assign-12-container" aria-controls="select2-team_assign-12-container">
                                    <span class="select2-selection__rendered" id="select2-team_assign-12-container" role="textbox" aria-readonly="true" title="Select a Team Member">
                                        <span class="select2-selection__placeholder">Select Status</span>
                                    </span>
                                    <span class="select2-selection__arrow" role="presentation">
                                        <b role="presentation"></b>
                                    </span>
                                </span>
                            </span>
                            <span class="dropdown-wrapper" aria-hidden="true"></span>
                        </span>
                            <option value="publish">Publish</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>      
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror           
                </div>


                {{-- <div class="row g-9 mb-8">
                    <div class="col-md-12 fv-row fv-plugins-icon-container">
                        <label for="fs-6 fw-bold mb-2">Category</label>
                        <select class="form-select select2-hidden-accessible" data-control="select-2" name="category">
                            <option disabled selected>Select Parent Category</option>

                        </select>
                        <div class="fv-plugins-message-contaier invalid-feedback">

                        </div>
                    </div>
                </div> --}}




                <div class="d-flex flex-column mb-8">
                    <label class="fs-6 fw-bold mb-2">Body</label>
                    <textarea class="form-control" rows="10" name="body" placeholder="Type Target Details">
                        {{ old('body') }}
                    </textarea>
                    @error('body')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Image</span>
                    </label>
                    <!--end::Label-->
                    <input type="file" class="form-control" name="thumbnail" placeholder="Enter Category" name="image">
                    <p>Image size 870*550 </p>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>

                <div class="text-center">
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                        <span class="indicator-label">Create Post</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>

            </form>
        </div>

    </div>
</section>
@endsection


