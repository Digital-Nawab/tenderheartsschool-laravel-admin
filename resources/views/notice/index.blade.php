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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Result</a></li>
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
                            <form method="post" action="{{ url('/add-notice') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="row gutters">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Notice </h5>
                                                </div>
                                                <div class="card-body row">
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Title</label>
                                                            <input type="text" class="form-control" name="title" placeholder="title" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">url</label>
                                                            <input type="text" class="form-control" name="url" placeholder="url" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Date</label>
                                                            <input type="date" class="form-control" name="date" placeholder="date" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Description</label>

                                                           <textarea name="description" placeholder="description" class="form-control" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                        <div class="col-md-12 text-center mt-3">
                                                            <button type="submit" class="btn btn-md btn-primary">Submit Notice </button>
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

        <div class="row mt-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All  Notice</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                            <thead class="text-muted table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">title/date</th>
                                <th scope="col">url/description</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $row)
                                <tr>
                                    <td>
                                        {!! $key+1 !!}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div class="flex-grow-1">{!! ucwords($row->title) !!} <br><b class="text-primary">{!! $row->date !!}</b></div>

                                        </div>
                                    </td>
                                    <td>
                                        <p><span class="badge badge-soft-success">{!! ucwords($row->url) !!}</span></p>
                                        <p>{!! $row->description !!}</p>
                                    </td>
                                    <td>
                                        <a class="confirmDelete btn btn-sm btn-danger" data-id="{{ $row->id }}">Delete</a>
                                    </td>
                                </tr><!-- end tr -->
                            @endforeach
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
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
                            window.location.href = "/delete-notice/" + id;
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
