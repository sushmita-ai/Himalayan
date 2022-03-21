@extends('layouts.admin.app')

@section('title', 'Dashboard')


@section('breadcrumb')
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
                <a href="{{route('admin.dashboard') }}" class="text-muted">Dashboard</a>
            </li>
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('admin.package.index')}}" class="text-muted">Package</a>
            </li>
        </ul>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center py-1">
            <!--begin::Button-->
            <a href="{{route('admin.package.create')}}" class="btn btn-sm btn-primary"
                id="kt_toolbar_primary_button">Create
                Package</a>
            <!--end::Button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Container-->
</div>

@endsection


@section('page-specific-styles')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<style>
    #tableData tbody tr:hover {
        background: #cff5ff;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 class="card-label">Package List</h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="PackageData">
                    <thead>
                    <tr>
                        <th class="notexport">ID</th>
                        <th>S.No.</th>
                        <th class="notexport">Image</th>
                        <th class="notexport">Name</th>
                        <th >Category</th>
                        <th>Price</th>
                        <th>Trip Duration</th>
                        <th>Status</th>
{{--                        <th>Feature</th>--}}
{{--                        <th>Trending</th>--}}
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
@endsection
@section('page-specific-scripts')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script>
    /******/
    (() => { // webpackBootstrap
        /******/
        "use strict";
        var __webpack_exports__ = {};
        /*!************************************************************!*\
          !*** ../demo1/src/js/pages/crud/datatables/basic/basic.js ***!
          \************************************************************/

        var KTDatatablesBasicBasic = function() {

            var initTable1 = function() {
                var table = $('#PackageData');

                // begin first table
                var table1 = table.DataTable({
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    order: [
                        [0, 'desc']
                    ],
                    stateSave: true,
                    ajax: {
                        url: "{{ route('admin.package.data') }}",
                    },
                    columns: [
                        {
                            "data": "id",
                            'visible': false
                        },
                        {
                            "data": "DT_RowIndex",
                            orderable: true,
                            searchable: false
                        },                        {
                            "data": "image"
                        },
                        {
                            "data": "title"
                        },
                        {
                          "data":"category_id"
                        },
                        {
                            "data":"price"
                        },
                        {
                            "data":"trip_duration"
                        },

                        {
                            "data": "status"
                        },
                        {
                            "data": "actions",
                            orderable: false,
                            searchable: false
                        },
                    ],
                    columnDefs: [{
                        targets: -1,
                        className: 'float-end'
                    }],

                });




            };

            return {
                //main function to initiate the module
                init: function() {
                    initTable1();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTDatatablesBasicBasic.init();
        });

        /******/
    })();
</script>
@endsection
