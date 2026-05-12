@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page header start -->
            <div class="row gutters">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{$title}}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="{!! url('/all-branch') !!}">Branch</a></li>
                                <li class="breadcrumb-item active">{{$title}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page header end -->
            <div class="row gutters">
                <div class="col-12">
                    <!-- Wizard start -->
                    <div id="example-form">
                        <section>
                            <div id="message-container">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (Session::has('success_msg'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ Session('success_msg') }}</strong>
                                    </div>
                                @endif
                                @if (Session::has('error_msg'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ Session('error_msg') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <form method="post" action="{{ url('/add-branch/' . ($branch->id ?? '')) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="row gutters">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Branch Basic Info </h5>
                                                </div>
                                                <div class="card-body row">
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Branch Title</label>
                                                            <input type="text" class="form-control" id="category_name"
                                                                   name="title" value="{{ old('title', $branch->title ?? '') }}"
                                                                   placeholder="Service Name" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="eMail">Branch Url</label>
                                                            <input type="text" class="form-control" id="category_url"
                                                                   name="slug_url" value="{{ old('slug_url', $branch->slug_url ?? '') }}"
                                                                   placeholder="Service Url" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <label>Is Front</label>
                                                        <div class="form-group mb-2">
                                                            <select class="form-control" name="is_front">
                                                                <option value="yes" {{ old('is_front', $branch->is_front ?? '') == 'yes' ? "selected" : '' }}>Yes</option>
                                                                <option value="no" {{ old('is_front', $branch->is_front ?? '') == 'no' ? "selected" : '' }}>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="category_image">Branch Image 419*283px Max=500KB</label><br>
                                                            <input type="file" class="form-control" id="category_image" name="image" onchange="previewImage(event, 'category_image_preview')">
                                                            <img id="category_image_preview" src="{{ old('image', asset($branch->image ?? '')) }}" alt="Category Image Preview" style="max-width: 100%; margin-top: 10px;" />
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="category_banner">Banner Image 1920*480px Max=500KB</label><br>
                                                            <input type="file" class="form-control" id="category_banner" name="banner" onchange="previewImage(event, 'category_banner_preview')">
                                                            <img id="category_banner_preview" src="{{ old('banner', asset($branch->banner ?? '')) }}" alt="Banner Image Preview" style="max-width: 100%; margin-top: 10px;" />
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="mobile_banner">Mobile Banner Image 500*500px Max=500KB</label><br>
                                                            <input type="file" class="form-control" id="mobile_banner" name="mobile_banner" onchange="previewImage(event, 'mobile_banner_preview')">
                                                            <img id="mobile_banner_preview" src="{{ old('mobile_banner', asset($branch->mobile_banner ?? '')) }}" alt="Mobile Banner Image Preview" style="max-width: 100%; margin-top: 10px;" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row p-2 ">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Service Short Description</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="eMail"> Description</label>
                                                                <textarea name="description" placeholder="Product Short Description" class="form-control" rows="5">{{ old('description', $branch->description ?? '') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row p-2">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Branch About Section </h5>
                                                </div>
                                                <div class="card-body row">
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Branch About Title</label>
                                                            <input type="text" class="form-control" id="about_title"
                                                                   name="about_title" value="{{ old('about_title', $branch->about_title ?? '') }}"
                                                                   placeholder="Branch About Title" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="eMail">About Heading</label>
                                                            <input type="text" class="form-control" id="about_heading"
                                                                   name="about_heading" value="{{ old('about_heading', $branch->about_heading ?? '') }}"
                                                                   placeholder="Branch About Heading" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="eMail">About Sub Heading</label>
                                                            <input type="text" class="form-control" id="about_subheading"
                                                                   name="about_subheading" value="{{ old('about_subheading', $branch->about_subheading ?? '') }}"
                                                                   placeholder="Branch About Sub Heading" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="category_image">About Image 640*430px Max=500KB</label><br>
                                                            <input type="file" class="form-control" id="about_image" name="image" onchange="previewImage(event, 'about_image')">
                                                            <img id="about_image" src="{{ old('image', asset($branch->image ?? '')) }}" alt="Category Image Preview" style="max-width: 100%; margin-top: 10px;" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="eMail"> About Description</label>
                                                            <textarea name="about_description" placeholder="Product Short Description" class="form-control" rows="5">{{ old('about_description', $branch->about_description ?? '') }}</textarea>
                                                        </div>
                                                    </div>


                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="eMail"> Learners at THS</label>
                                                            <textarea name="ths" placeholder="Product Short Description" class="form-control" rows="5">{{ old('ths', $branch->ths ?? '') }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="eMail"> Happy Classrooms, Happy Learning!</label>
                                                            <textarea name="learn" placeholder="learn" class="form-control" rows="5">{{ old('learn', $branch->learn ?? '') }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="eMail"> Flexible Learning Environment</label>
                                                            <textarea name="environment" placeholder="Environment" class="form-control" rows="5">{{ old('environment', $branch->environment ?? '') }}</textarea>
                                                        </div>
                                                    </div>





                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-md btn-primary">Submit </button>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const categoryNameInput = document.getElementById("category_name");
            const categoryUrlInput = document.getElementById("category_url");
            categoryNameInput.addEventListener("input", function() {
                var title = this.value.toLowerCase();
                var res = title.replace(/ /g, "-");
                categoryUrlInput.value = res;
            });
        });
    </script>
    <script>
        function previewImage(event, previewId) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById(previewId);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@stop
