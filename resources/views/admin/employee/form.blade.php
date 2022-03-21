@section('page-specific-style')
{{--
<link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" /> --}}
@endsection

<div class="row" data-sticky-container>
    <div class="col-lg-8 col-xl-9">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col">
                        <label>First Name
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                            placeholder="Enter First Name" name="first_name"
                            value="@if(isset($employee)){{$employee->first_name}}@else{{old('first_name')}}@endif"
                            required />
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col">
                        <label>Last Name
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                            placeholder="Enter Last Name" name="last_name"
                            value="@if(isset($employee)){{$employee->last_name}}@else{{old('last_name')}}@endif"
                            required />
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col">
                        <label>Email</label>

                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter Email" name="email"
                            value="@if(isset($employee)){{$employee->email}}@else{{old('email')}}@endif" required />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col">
                        <label>Phone<span class="text-danger">*</span>
                        </label>
                        <input type="number" data-parsley-type="digits"
                            class="form-control @error('phone') is-invalid @enderror" placeholder="9800000000"
                            name="phone" value="@if(isset($employee)){{$employee->phone}}@else{{old('phone')}}@endif"
                            required />
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col-6">
                        <label>Username
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                            placeholder="Enter Username" name="username"
                            value="@if(isset($employee)){{$employee->username}}@else{{old('username')}}@endif"
                            required />
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label>Gender
                            <span class="text-danger">*</span>
                        </label>
                        <select name="gender" id="gender_select" class="form-control">
                            <option value="Male" {{ old('gender', isset($employee->gender) ? $employee->gender : '') ==
                                "Male" ? "selected":"" }}>Male</option>
                            <option value="Female" {{ old('gender', isset($employee->gender) ? $employee->gender : '')
                                == "Female" ? "selected": "" }}>Female</option>
                        </select>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>

                <div class="form-group row mt-5">
                    <div class="col">

                        <label>Date of Birth</label>

                        <input type="text" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob"
                            readonly="readonly" placeholder="Select date"
                            value="{{old('dob',isset($employee->dob) ? $employee->dob : '')}}" autocomplete="off"
                            data-parsley-errors-container="#dob-errors" required />

                        @error('dob')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xl-3">
        <div class="card card-custom sticky" data-sticky="true" data-margin-top="140" data-sticky-for="1023"
            data-sticky-class="stickyjs">
            <div class="card-body">

                <div class="form-group row">
                    <label class="col-6 ">Status</label>
                    <div class="col-6">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" name="status" type="checkbox" {{ old('status',
                                isset($employee->status) ?
                            $employee->status : '' )=='active' ? 'checked' :'' }} {{ (old('status')=='on' )
                            ? 'checked' :'' }} />
                            {{-- <span class="form-check-label fw-bold text-muted">
                                Save Card
                            </span> --}}
                        </label>

                        {{-- {{dd($rider['status'])}} --}}
                        {{-- <input type="checkbox" name="status" {{ old('status', isset($employee->status) ?
                        $employee->status : '' )=='active' ? 'checked' :'' }} {{ (old('status')=='on' )
                        ? 'checked' :'' }} />
                        <span></span> --}}
                    </div>
                </div>
                <div class="form-group row mt-5">
                    <label class="col-xl-12 col-lg-12 col-form-label text-left">Profile Image</label>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="col-lg-12 col-xl-12">
                        <!--begin::Image input-->
                        <div class="image-input image-input-circle" data-kt-image-input="true"
                            style="background-image: url({{asset('assets/media/svg/avatars/007-boy-2.svg')}})">
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-125px h-125px" @if(isset($employee->image))
                                style="background-image:url({{asset($employee->image_path) }})"
                                @else
                                style="background-image: url({{asset('assets/media/svg/avatars/007-boy-2.svg')}})"
                                @endif></div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>

                                <!--begin::Inputs-->
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Edit button-->

                            <!--begin::Cancel button-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel button-->

                            <!--begin::Remove button-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove button-->
                        </div>
                        <!--end::Image input-->
                        {{-- <div class="image-input image-input-empty image-input-outline" id="kt_image_1">
                            <div class="image-input-wrapper" @if(isset($employee->image))
                                style="background-image:url({{asset($employee->image_path) }})"
                                @else
                                style="background-image:url({{asset('assets/admin/media/users/blank.png') }})"
                                @endif></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title="" data-original-title="Change image">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="image_remove" />
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip" title="Cancel image">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="remove" data-toggle="tooltip" title="Remove image">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div> --}}
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>


@section('page-specific-scripts')
{{-- <script src="{{asset('assets/plugins/custom/parsleyjs/parsley.min.js')}}"></script>
<script src="{{asset('assets/js/pages/crud/file-upload/image-input.js')}}"></script>
<script src="{{asset('assets/js/pages/features/miscellaneous/sticky-panels.js')}}"></script>
<script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script> --}}


<script>
    $("#dob").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});


</script>
@endsection