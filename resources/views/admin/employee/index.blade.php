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
                <a href="{{ route('admin.employee.index')}}" class="text-muted">Employee</a>
            </li>
            <li class="breadcrumb-item text-active">
                <a href="#" class="text-active">Listing</a>
            </li>
        </ul>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center py-1">
            <!--begin::Button-->
            <a href="{{route('admin.employee.create')}}" class="btn btn-sm btn-primary"
                id="kt_toolbar_primary_button">Create
                Employee</a>
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
                    <h3 class="card-label">Employee List</h3>
                </div>
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline">
                        <button type="button" class="btn btn-secondary btn-sm font-weight-bold" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="la la-download"></i>Export</button>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="navi flex-column navi-hover py-2">
                                <li
                                    class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">
                                    Export Tools</li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link" id="export_print">
                                        <span class="navi-icon">
                                            <i class="la la-print"></i>
                                        </span>
                                        <span class="navi-text">Print</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link" id="export_copy">
                                        <span class="navi-icon">
                                            <i class="la la-copy"></i>
                                        </span>
                                        <span class="navi-text">Copy</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link" id="export_excel">
                                        <span class="navi-icon">
                                            <i class="la la-file-excel-o"></i>
                                        </span>
                                        <span class="navi-text">Excel</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link" id="export_csv">
                                        <span class="navi-icon">
                                            <i class="la la-file-text-o"></i>
                                        </span>
                                        <span class="navi-text">CSV</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link" id="export_pdf">
                                        <span class="navi-icon">
                                            <i class="la la-file-pdf-o"></i>
                                        </span>
                                        <span class="navi-text">PDF</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="tableData">
                    <thead>
                        <tr>
                            <th class="notexport">ID</th>
                            <th>S.No.</th>
                            <th class="notexport">Image</th>
                            <th class="notexport">Employee Name</th>
                            <th>Username</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th class="notexport">Action</th>
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
                var table = $('#tableData');

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
                        url: "{{ route('admin.employee.data') }}",
                    },
                    buttons: [
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(.notexport)',
                            }
                        },
                        {
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(.notexport)',
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(.notexport)',
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(.notexport)',
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(.notexport)',
                            }
                        }
                    ],
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
                            "data": "name"
                        },
                        {
                            "data": "username"
                        },
                        {
                            "data": "gender"
                        },
                        {
                            "data": "phone"
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

                $('#export_print').on('click', function(e) {
                    e.preventDefault();
                    table1.button(0).trigger();
                });

                $('#export_copy').on('click', function(e) {
                    e.preventDefault();
                    table1.button(1).trigger();
                });

                $('#export_excel').on('click', function(e) {
                    e.preventDefault();
                    table1.button(2).trigger();
                });

                $('#export_csv').on('click', function(e) {
                    e.preventDefault();
                    table1.button(3).trigger();
                });

                $('#export_pdf').on('click', function(e) {
                    e.preventDefault();
                    table1.button(4).trigger();
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