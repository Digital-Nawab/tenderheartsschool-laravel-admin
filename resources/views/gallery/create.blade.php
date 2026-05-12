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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
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
                            <form method="post" action="{{ url('/add-gallery') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="row gutters">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">{{ $title }} </h5>
                                                </div>
                                                <div class="card-body row">
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Title <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="title" placeholder="Gallery Name" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <label>Select Gallery Service <span class="text-danger">*</span></label>
                                                        <div class="form-group mb-2">
                                                            <select class="form-control" name="service_id" required>
                                                                @foreach ($services as $service)
                                                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                        <label>Is Front <span class="text-danger">*</span></label>
                                                        <div class="form-group mb-2">
                                                            <select class="form-control" name="is_front" required>
                                                                <option value="no" {{ old('is_front', $service->is_front ?? '') == 'no' ? "selected" : '' }}>No</option>
                                                                <option value="yes" {{ old('is_front', $service->is_front ?? '') == 'yes' ? "selected" : '' }}>Yes</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="Slider_image">Gallery Image 1080*1080 Max=100KB</label><br>
                                                            <input type="file" class="form-control" id="image" name="image[]" onchange="previewImage(event, 'image_preview')" multiple required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12">
                                                        <img id="image_preview" src="" alt="Offer Image Preview" style="max-width: 100%; margin-top: 10px;" />
                                                    </div>
                                                        <div class="col-md-12 text-center mt-3">
                                                            <button type="submit" class="btn btn-md btn-primary">Submit Gallery</button>
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


            <div class="row">
                <div class="col-xxl-12">
                    <h5 class="mb-3">All Gallery By Services</h5>
                    <div class="card">
                        <div class="card-header align-items-xl-center d-xl-flex">
                            <div class="flex-shrink-0">
                                <ul class="nav nav-pills card-header-pills" role="tablist">
                                    @foreach($services as $key=>$row )
                                        <li class="nav-item">
                                            <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-bs-toggle="tab" href="#developer_{!! $key+1 !!}" role="tab">
                                                {!! $row->title !!}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <!-- Tab panes -->
                            <div class="tab-content text-muted">
                                @foreach($services as $key=>$row )
                                <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="developer_{!! $key+1 !!}" role="tabpanel">
                                    <div class="row">
                                        @foreach ($data as $gallery)
                                            @if($gallery->service_id == $row->id)
                                                <div class="col-sm-3 col-xl-2">
                                                    <!-- Simple card -->
                                                    <div class="card border">
                                                        <p class="text-center">{{ ucwords($gallery->title) }}</p>
                                                        <img class="card-img-top img-fluid" src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}">
                                                        <!-- Delete icon overlay -->
                                                        <div class="remove">
                                                            <a class="float-start p-2"
                                                               data-id="{{ $gallery->id }}">Front View :   <span class="text-{{ $gallery->is_front == 'yes' ? 'success' : 'danger' }} p-2">{{ $gallery->is_front == 'yes' ? 'Yes' : 'No' }}</span></a>
                                                            <a class="confirmDelete btn btn-sm btn-danger remove-item-btn float-end mr-2 me-2"
                                                               data-id="{{ $gallery->id }}">Remove</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <!--end row-->
                                </div>
                                @endforeach
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <!--end col-->
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
                            window.location.href = "/delete-gallery/" + id;
                        }
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
