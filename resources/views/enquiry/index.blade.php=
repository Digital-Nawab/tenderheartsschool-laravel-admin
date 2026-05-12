@extends('layouts.app')
@section('style')
    <style>
        .delete-icon {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 5px;
            border-radius: 50%;
            transition: background-color 0.3s ease;
        }

        .delete-icon:hover {
            background-color: rgba(255, 255, 255, 1);
        }
        div:where(.swal2-icon) .swal2-icon-content {
            display: flex;
            align-items: center;
            font-size: 1.2em !important;
        }

        .swal2-popup .swal2-styled {
            margin: 0px 5px 0 !important;
            padding: 10px 32px;
        }
    </style>
@stop
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page header start -->
            <div class="row gutters">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $title }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                                <li class="breadcrumb-item active">{{ $title }}</li>
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
                            <form method="post" action="{{ url('/slider') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="row gutters">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Slider </h5>
                                                </div>
                                                <div class="card-body row">
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Alt Text</label>
                                                            <input type="text" class="form-control" name="alt_text"
                                                                placeholder="Alt Text" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="Slider_image">Slider Image 1920*650px
                                                                Max=500KB</label><br>
                                                            <input type="file" class="form-control" id="category_image"
                                                                name="slider_image"
                                                                onchange="previewImage(event, 'category_image_preview')">
                                                            <img id="category_image_preview" src=""
                                                                alt="Slider Image Preview"
                                                                style="max-width: 100%; margin-top: 10px;" />
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="Mobile Slider">Mobile Slider 1080*1080px
                                                                Max=1MB</label><br>
                                                            <input type="file" class="form-control" id="category_banner"
                                                                name="mobile_image"
                                                                onchange="previewImage(event, 'category_banner_preview')">
                                                            <img id="category_banner_preview" src=""
                                                                alt="Mobile Image Preview"
                                                                style="max-width: 100%; margin-top: 10px;" />
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

            <div class="row mt-5">
                @foreach ($data as $row)
                    <div class="col-sm-6 col-xl-3">
                        <!-- Simple card -->
                        <div class="card">
                            <div class="row">
                                <div class="col-8 p-0">

                                        <img class="img-fluid w-100" src="{{ asset($row->slider_image) }}" alt="{!! $row->alt_text !!}">

                                </div>
                                <div class="col-4 p-0">

                                        <img class="img-fluid w-100 " src="{{ asset($row->mobile_image) }}" alt="{!! $row->alt_text !!}">
                                   
                                </div>
                            </div>
                            <div class="remove">
                                <a class="confirmDelete btn btn-sm btn-danger w-100 remove-item-btn"
                                   data-id="{{ $row->id }}">Remove</a>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    @endsection
   @section('scripts')
   <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', ".confirmDelete", function() {
            var id = $(this).attr('data-id');
            console.log(id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                console.log(result);
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    window.location.href = "/delete-slider/" + id;
                }
            });
        });
    </script>
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
                reader.onload = function() {
                    var output = document.getElementById(previewId);
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    @stop
