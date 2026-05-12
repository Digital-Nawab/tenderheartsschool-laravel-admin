@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page header start -->
            <div class="row gutters">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Recent Contact</h4>
                            {{--<div class="flex-shrink-0">
                                <button type="button" class="btn btn-soft-info btn-sm">
                                    <i class="ri-file-list-3-line align-middle"></i> Download Report
                                </button>
                            </div>--}}
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">

                                <!-- Top Pagination -->
                                <div class="d-flex justify-content-end mb-3">
                                    {!! $data->links('pagination::bootstrap-5') !!}
                                </div>

                                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                    <tr>
                                        <th>Action</th>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Subject / Resume</th>
                                        <th>Email / Mobile</th>
                                        <th>Message</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($data as $row)
                                        <tr>
                                            <td>
                                                <a class="confirmDelete btn btn-sm btn-danger" data-id="{{ $row->id }}">
                                                    Delete
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="fw-medium link-primary">
                                                    #THS-000{{ $row->id }} <br>
                                                    {!! $row->create_at !!}
                                                </a>
                                            </td>

                                            <td>
                                                {{ ucwords($row->first_name) }} {{ ucwords($row->last_name) }}
                                            </td>

                                            <td>
                                                <span class="badge bg-success">
                                                    {{ ucwords($row->subject) }}
                                                </span>
                                                <p><a target="_blank" href="{{ asset($row->resume) }}">{{ asset($row->resume) }}</a></p>
                                            </td>

                                            <td>
                                                <span class="text-success">{{ $row->email }}</span><br>
                                                <span class="text-muted">{{ $row->phone }}</span>
                                            </td>

                                            <td style="max-width: 250px; white-space: normal; word-break: break-word;">
                                                {{ $row->message }}
                                            </td>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <!-- Bottom Pagination -->
                                <div class="d-flex justify-content-end mt-3">
                                    {!! $data->links('pagination::bootstrap-5') !!}
                                </div>

                            </div>
                        </div>
                    </div> <!-- .card-->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include these once (preferably in your layout) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery + SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on('click', '.confirmDelete', function (e) {
    e.preventDefault();

    var id  = $(this).data('id');
    var url = "/update-career/" + id;

    Swal.fire({
        title: "Are you sure?",
        text: "This will update the career status.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, update it!",
        cancelButtonText: "Cancel",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
    }).then((result) => {
        if (!result.isConfirmed) return;

        $.get(url, function (res) {
            Swal.fire({
                title: "Success!",
                text: res.message || "Career status updated successfully.",
                icon: "success"
            }).then(() => {
                // refresh page after user clicks OK
                window.location.reload();
            });
        }).fail(function (xhr) {
            let msg = xhr.responseJSON?.message || "Something went wrong!";
            Swal.fire("Error", msg, "error");
        });
    });
});
</script>


    <script>
        function previewImage(event, previewId) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById(previewId);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@stop

