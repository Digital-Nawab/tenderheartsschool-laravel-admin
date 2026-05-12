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
                <div class="col-8">
                    <div class="table-responsive table-card mt-3 card m-3">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                <tr>
                                    <th class="sort">#</th>
                                    <th class="sort">Meta Data</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($data as $key => $row)
                                    <tr class="">

{{--                                        <td>{{ $key + 1 }} <img width="60px" src="{!! asset($row->image) !!}" alt=""></td>--}}

                                        <td class="email">
                                            <div class="email-container">
                                                @if (!empty($row->image) && file_exists(public_path($row->image)))
                                                    <div class="email-image">
                                                        <img width="60px" src="{!! asset($row->image) !!}" alt="">
                                                    </div>
                                                @endif
                                                <div class="email-content">
                                                    @if($row->url != null || $row->url != '')
                                                        <p class="p-0 m-0 text-danger"><strong class="">Url:</strong> {!! $row->url !!}
                                                            <a class="confirmDelete btn btn-sm btn-danger remove-item-btn ml-2 ms-4" data-id="{{ $row->id }}">PERMANENT DELETE</a>
                                                        </p>
                                                    @endif
                                                    @if($row->title != null || $row->title != '')
                                                        <p class="p-0 m-0 text-success"><strong>Title:</strong> {!! $row->title !!}</p>
                                                    @endif
                                                    @if($row->description != null || $row->description != '')
                                                        <p class="p-0 m-0 text-primary"><strong>Description:</strong> {!! $row->description !!}</p>
                                                    @endif
                                                    @if($row->keyword != null || $row->keyword != '')
                                                        <p class="p-0 m-0"><strong>Keyword:</strong> {!! $row->keyword !!}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                               colors="primary:#121331,secondary:#08a88a"
                                               style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find
                                        any orders for you search.</p>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-4">
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
                            <form method="post" action="{{ url('/add-meta-tag') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="row gutters">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0"> {{ $title }} </h5>
                                                </div>
                                                <div class="card-body row">
							                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Page Url  <span class="text-danger">*</span></label>
                                                            <input type="url" class="form-control" value="{!! old('url') !!}" name="url" placeholder="Url Link" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Title <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" value="{!! old('title') !!}" name="title" placeholder="Meta Title" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Description <span class="text-danger">*</span></label>
                                                            <textarea  rows="3" class="form-control" name="description" placeholder="Meta Description" required>
                                                                {!! old('description') !!}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Keyword</label>
                                                            <textarea  rows="3" class="form-control" name="keyword" placeholder="Meta Keyword">
                                                                {!! old('keyword') !!}
                                                            </textarea>
                                                        </div>
                                                    </div>


                                                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
                                                        <div class="form-group mb-2">
                                                            <label for="Slider_image">Tag Image 200*200 Max=50KB</label><br>
                                                            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event, 'image_preview')" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                                        <img id="image_preview"
                                                             src="{{ old('image') ?? asset('assets/images/logo.png') }}"
                                                             alt="Image Preview"
                                                             style="max-width: 100%; margin-top: 10px;" />

                                                    </div>


                                                    <div class="col-md-12 text-center mt-3">
                                                        <button type="submit" class="btn btn-md btn-primary">Submit Brand</button>
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
                            window.location.href = "/delete-meta-tag/" + id;
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
