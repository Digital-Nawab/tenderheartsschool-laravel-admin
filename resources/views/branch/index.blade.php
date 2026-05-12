@extends('layouts.app')
@section('style')
    <style>
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

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Branch</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Branch</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">All Branch</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-start">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search" placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ url('/add-branch') }}" class="btn btn-success add-btn"><i
                                                    class="ri-add-line align-bottom me-1"></i> Add Branch</a>
                                           {{-- <button class="btn btn-soft-danger" onclick="deleteMultiple()"><i
                                                    class="ri-delete-bin-2-line"></i></button>--}}
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll"
                                                            value="option">
                                                    </div>
                                                </th>
                                                <th class="sort">#</th>
                                                <th class="sort">Branch Image</th>
                                                <th class="sort">Branch Name</th>
                                                <th class="sort">Branch Url</th>
                                                <th class="sort">Is Front</th>
                                                <th class="sort">Status</th>
                                                <th class="sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($branch as $key => $row)
                                                <tr class="">
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="chk_child"
                                                                value="option1">
                                                        </div>
                                                    </th>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <img src="{{ asset($row->image) }}" class="img-circle"
                                                            style="height: 50px; width: 50px;border-radius:50%;object-fit: cover;object-position: 100%;"
                                                            alt="">
                                                    </td>
                                                    <td class="email">{{ $row->title }}</td>
                                                    <td class="date">{{ $row->slug_url }}</td>
                                                    <td class="phone">{{ $row->is_front }}</td>
                                                    <td class="status"><span
                                                            class="badge badge-soft-success text-uppercase">Active</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">

                                                                <a href="{{ url('/add-about-branch/' . base64_encode($row->id)) }}"
                                                                   class="btn btn-sm btn-primary edit-item-btn">
                                                                    ADD  Branch ABOUT
                                                                </a>
                                                            </div>
                                                            <div class="edit">
                                                                <a href="{{ url('/add-branch-facilities/' . base64_encode($row->id)) }}"
                                                                    class="btn btn-sm btn-primary edit-item-btn">
                                                                    ADD Branch Facilities
                                                                </a>
                                                            </div>
                                                            <div class="edit">
                                                                <a href="{{ url('/add-branch/' . $row->id) }}"
                                                                    class="btn btn-sm btn-success edit-item-btn">
                                                                    EDIT/UPDATE
                                                                </a>
                                                            </div>

                                                            <div class="remove">
                                                                @if($row->is_active == 2)
                                                                    <a class="updateStatus btn btn-sm btn-success remove-item-btn" data-id="{{ $row->id }}">ACTIVE</a>
                                                                @else
                                                                    <a class="updateStatus btn btn-sm btn-danger remove-item-btn" data-id="{{ $row->id }}">INACTIVE</a>
                                                                @endif
                                                            </div>


                                                            <div class="remove">
                                                                <a class="confirmDelete btn btn-sm btn-dark remove-item-btn"
                                                                data-id="{{ $row->id }}">PERMANENT DELETE</a>
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

                                {{--<div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="#">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0">
                                            <li class="active"><a class="page" href="#" data-i="1"
                                                    data-page="8">1</a></li>
                                        </ul>
                                        <a class="page-item pagination-next" href="#">
                                            Next
                                        </a>
                                    </div>
                                </div>--}}
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', ".confirmDelete", function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    window.location.href = "/delete-service/" + id;
                }
            });
        });
    </script>
@stop
