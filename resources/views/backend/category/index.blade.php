@extends('layouts.backend')
@section("titile", "categories")

@section('content')
<section> 
    <div class="row ml-10">
        <div class="col-lg-4 bg-white">
            <h2 class="py-3 mb-5 text-center">Add Category</h2>
            
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route("category.store") }}" 
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Category Name</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Category" name="name">
                    <div class="fv-plugins-message-container invalid-feedback">
                    </div>
                </div>
                
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-12 fv-row">
                        <label class="fs-6 fw-bold mb-2">Parent Category</label>
                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" name="parent_id ">
                            <option value="0">Sports</option>
                            <option value="1">football</option>
                            <option value="2">Cricket</option>
                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-11-btgu" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-team_assign-12-container" aria-controls="select2-team_assign-12-container"><span class="select2-selection__rendered" id="select2-team_assign-12-container" role="textbox" aria-readonly="true" title="Select a Team Member"><span class="select2-selection__placeholder">Select a Team Member</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                    </div>                 
                </div>
                <div class="d-flex flex-column mb-8">
                    <label class="fs-6 fw-bold mb-2">Descripton</label>
                    <textarea class="form-control" rows="3" name="description" placeholder="Type Target Details"></textarea>
                </div>

                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Category Image</span>
                    </label>
                    <!--end::Label-->
                    <input type="file" class="form-control" name="image" placeholder="Enter Category" name="image">
                    <p>Image size 300*300 </p>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>

                <div class="text-center">
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>

            </form>
        </div>

        <div class="col-lg-8">
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">All Category</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button">Active</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button">Trash</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home">
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <thead>
                                        <tr class="fw-bolder text-muted">
                                            <th class="w-25px">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" dark-kt-check="true" data-kt-check-target=".widget-9-check">
                                                </div>
                                            </th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Post Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input widget-9-check" type="checkbox" value="{{ $category->id }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="symbol symbol-45px me-5">
                                                    <img src="{{ asset('storage/uploads/categories/'.$category->image) }}" alt="{{ $category->name }}">
                                                </div>
                                            </td>
                                            <td>
                                                <strong>{{ $category->name }}</strong>
                                            </td> 
                                            <td>
                                                <strong>{{ $category->slug }}</strong>
                                            </td>
                                            <td>
                                                <strong>{{ count($category->posts ) }}</strong>
                                            </td>  
                                            <td>
                                                <a href="{{ route('category.show', $category->id) }}" class="badge badge-light-primary fs-7 fw-bold">View</a>
                                                <a href="{{ route('category.edit', $category->id) }}" class="badge badge-light-warning fs-7 fw-bold">Edit</a>
                                                <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="badge badge-light-danger fs-7 fw-bold">Delete</button>
                                                </form>

                                            </td>
                                            </tr>
                                                @empty
                                            <tr>
                                                <td colspan="5">No Categories</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                            <div class="tab-pane fade" id="profile">

                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <thead>
                                        <tr class="fw-bolder text-muted">
                                            <th class="w-25px">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" dark-kt-check="true" data-kt-check-target=".widget-9-check">
                                                </div>
                                            </th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($trashCategories as $category)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input widget-9-check" type="checkbox" value="{{ $category->id }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="symbol symbol-45px me-5">
                                                    <img src="{{ asset('storage/uploads/categories/'.$category->image) }}" alt="{{ $category->name }}">
                                                </div>
                                            </td>
                                            <td>
                                                <strong>{{ $category->name }}</strong>
                                            </td> 
                                            <td>
                                                <strong>{{ $category->slug }}</strong>
                                            </td> 
                                            <td>
                                                <a href="{{ route('category.restore',$category->id) }}" class="badge badge-light-success fs-7 fw-bold">Restore</a>
                                                <a href="{{ route('category.hard.delete',$category->id) }}" class="badge badge-light-danger fs-7 fw-bold">Hard Delete</a>
                                            </td>
                                        </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5">No Categories</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
</section>
@endsection


