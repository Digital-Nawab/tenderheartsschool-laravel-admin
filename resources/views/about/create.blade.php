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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">About</a></li>
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
                            <form method="post" action="{{ url('/add-about/' . ($about->id ?? '')) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-9 p-3">
                                        <div class="row gutters">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">About Basic Info </h5>
                                                </div>
                                                <div class="card-body row">

                                                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="eMail">About Heading <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                   name="heading" value="{{ old('heading', $about->heading ?? '') }}"
                                                                   placeholder="Service Url" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">About Sub Title</label>
                                                            <input type="text" class="form-control" id="category_name"
                                                                   name="title" value="{{ old('title', $about->title ?? '') }}"
                                                                   placeholder="Service Name" />
                                                        </div>
                                                    </div>


                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="eMail"> Description</label>
                                                            <textarea name="description" placeholder=" Description" class="form-control ckeditor " rows="5">{{ old('description', $about->description ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <label>Is Front</label>
                                                        <div class="form-group mb-2">
                                                            <select class="form-control" name="is_index">
                                                                <option value="Y" {{ old('is_index', $about->is_index ?? '') == 'Y' ? "selected" : '' }}>Home Page </option>
                                                                <option value="N" {{ old('is_index', $about->is_index ?? '') == 'N' ? "selected" : '' }}>About Us Page</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="category_image"> Image 1080*1080px Max=500KB</label><br>
                                                            <input  type="file" name="file" id="file" class="form-control" accept="image/*,video/*" class="form-control"  onchange="previewImage(event, 'image_preview')">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-center mt-3">
                                                        <button type="submit" class="btn btn-lg btn-primary">Submit and  upload </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 p-3">
                                        <div class="row gutters">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">About Image Preview  </h5>
                                                </div>
                                                <div class="card-body row">
                                                    <div class="col-12">
                                                        <img id="image_preview" src="{{ old('image', asset($about->image ?? '')) }}" alt=" Image Preview" style="max-width: 100%; margin-top: 10px;" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    {{--            <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.25.0/ckeditor.min.js" integrity="sha512-Z85Fu7UNiaY9VJHpFZhXVWfw9dg8NIer0rqoaR52+iyLwQ2qg8qwwL0uUicd4vYJ6q4eOq8loyFG3jGHPLUiow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
    <script>

        // Replace all textareas with CKEditor
        CKEDITOR.replace('ckeditor');
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
