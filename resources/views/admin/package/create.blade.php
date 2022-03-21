@extends('layouts.admin.app')

@section('title', 'Add Package')

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
	</div>
	<!--end::Container-->
</div>

@section('content')
<form action="{{route('admin.package.store')}}" id ="data" data-parsley-validate="" class="custom-validation" method="post" enctype="multipart/form-data">
	@csrf
	@include('admin.package.form')

</form>
@endsection


@section('page-specific-scripts')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://parsleyjs.org/dist/parsley.min.js"></script>

    <script type="text/javascript">
        $('#data').parsley();
    </script>
@endsection
