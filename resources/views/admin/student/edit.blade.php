@extends('layouts.admin.app')

@section('title', 'Dashboard')

<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
                <a href="{{route('admin.dashboard') }}" class="text-muted">Dashboard</a>
            </li>
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('admin.student.index')}}" class="text-muted">Student</a>
            </li>
        </ul>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>

@section('content')
<form action="{{route('admin.student.update',$student->id)}}" method="post" class="custom-validation"
    enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    @include('admin.student.form')
</form>
@endsection
