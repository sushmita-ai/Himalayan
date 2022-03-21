@extends('layouts.admin.app')

@section('page-specific-styles')
<style>
    @media(min-width:992px) {
        .header-fixed.toolbar-fixed .wrapper {
            padding-top: 70px !important;
        }
    }

    @media(max-width:991.98px) {
        .header-tablet-and-mobile-fixed .wrapper {
            padding-top: 80px !important;
        }
    }

    .card-hover:hover {
        background: #cae4ff !important;
        box-shadow: 7px 4px 20px -5px rgba(0, 0, 0, 0.97) !important;
        -webkit-box-shadow: 7px 4px 20px -5px rgba(0, 0, 0, 0.97) !important;
        -moz-box-shadow: 7px 4px 20px -5px rgba(0, 0, 0, 0.97) !important;
    }
</style>
@endsection

@section('title')
Dashboard
@endsection
@section('breadcrumb')
{{-- <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item text-muted">
        <a href="#" class="text-muted">Dashboard</a>
    </li>
    <li class="breadcrumb-item text-active">
        <a href="#" class="text-active">Home</a>
    </li>
</ul> --}}
@endsection

@section('content')

<!--begin::Search-->
<div class="card shadow-sm">
    <div class="card-header">
        <div class="d-flex justify-content-between w-100">
            <div id="" class="d-flex align-items-stretch w-100 px-10" data-kt-search-keypress="true"
                data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu"
                data-kt-menu-trigger="auto" data-kt-menu-overflow="false" data-kt-menu-permanent="true"
                data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                <!--begin::Search toggle-->
                <div class="d-flex align-items-center w-100 mr-10">
                    <div class="h-35px w-100 ">
                        <div class="input-group mb-5">
                            <input id="search-input" type="text" class="form-control h-35px h-md-35px"
                                placeholder="Search...." value="" aria-label="Recipient's username"
                                aria-describedby="basic-addon2" onchange="searchTrigger(event)" autocomplete="off"
                                onkeyup="validateSearch(event)" />
                            <span class="input-group-text svg-icon svg-icon-1 h-35px h-md-35px">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path
                                            d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <!--end::Search toggle-->
            </div>
            <div class="card-toolbar cursor-pointer" data-bs-toggle="collapse"
                data-bs-target="#kt_docs_card_collapsible">
                <i class="fas fa-chevron-down "></i>
            </div>
        </div>


    </div>
    <div id="kt_docs_card_collapsible" class="collapse show">
        <div class="card-body" id="search-data">
            @include('admin.dashboard.search')
        </div>
    </div>
</div>

<!--end::Search-->
@endsection

@section('page-specific-scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })
    
    function searchTrigger(event) {
        console.log(event, event.target.value, "Printing value of search")
        if(event.target.value.length == 12 || event.target.value.length == 4) {
            //ajax request begins
            $.ajax({
            type: "GET",
            url: '{{route('admin.employee.search')}}',
            data: { 
                code: event.target.value
            },
            success:function(res)
            {
                console.log(res, "data from search ajax")
                Toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })
                if(res.data.view) {
                    $('#search-data').html(res.data.view);
                }
                // $('.preloader').addClass('hide');
            },
            error: function(error) {
                Toast.fire({
                    icon: 'error',
                    title: error.responseJSON.data.error
                })

                if(error.responseJSON.data.view) {
                    $('#search-data').html(error.responseJSON.data.view);
                }
            }
            });
        }
    }

    function validateSearch(event) {
        if(!(event.target.value.length == 0 || event.target.value.length == 12 || event.target.value.length == 4)) {
            $('#search-input').addClass('is-invalid')
            $('#search-input').removeClass('is-valid')
        }

        if(event.target.value.length == 0) {
            $('#search-input').removeClass('is-invalid')
            $('#search-input').removeClass('is-valid')
        }
        if(event.target.value.length == 12) {
            $('#search-input').removeClass('is-invalid')
            $('#search-input').addClass('is-valid')
        }
        if(event.target.value.length == 4) {
            $('#search-input').removeClass('is-invalid')
            $('#search-input').addClass('is-valid')
        }
    }

    function proccessCheckout(attendance_id, end_time, code) {
        $.ajax({
            type: "POST",
            url: '{{route('admin.attendance.payment')}}',
            data: { 
                attendance_id: attendance_id,
                code: code,
                end_time: end_time
            },
            success:function(res)
            {
                console.log(res, "data from search ajax")
                Toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })
                if(res.data.view) {
                    $('#search-data').html(res.data.view);
                }
            },
            error: function(error) {
                if(error.responseJSON.data.error) {
                    Toast.fire({
                        icon: 'error',
                        title: error.responseJSON.data.error
                    })
                }
                else {
                    Toast.fire({
                        icon: 'error',
                        title: "Something went wrong!!"
                    })
                }

            }
        });
    }

    function createAttendance(user_id=null, code=null) {
        console.log(user_id, code, " Printing data sent in ajax")

        $.ajax({
            type: "POST",
            url: '{{route('admin.attendance.create.ajax')}}',
            data: { 
                user_id: user_id,
                code: code
            },
            success:function(res)
            {
                console.log(res, "data from search ajax")
                Toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })
                if(res.data.view) {
                    $('#search-data').html(res.data.view);
                }
            },
            error: function(error) {
                if(error.responseJSON.data.error) {
                    Toast.fire({
                    icon: 'error',
                    title: error.responseJSON.data.error
                })
                }
                else {
                    Toast.fire({
                    icon: 'error',
                    title: "Something went wrong!!"
                    })
                }

            }
        });
    }
</script>
@endsection