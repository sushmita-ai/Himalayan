@extends('layouts.admin.app')

@section('title', 'Login')

{{-- @section('page-specific-scripts')
<script src="assets/js/custom/authentication/sign-up/free-trial.js"></script>
@endsection --}}

@section('guest')
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Signup Free Trial-->
    <div class="d-flex flex-column flex-xl-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-lg-row-fluid">
            <!--begin::Wrapper-->
            <div class="d-flex flex-row-fluid flex-center p-10">
                <!--begin::Content-->
                <div class="d-flex flex-column">
                    <!--begin::Logo-->
                    <a href="../../demo1/dist/index.html" class="mb-15">
                        <h1 class="display-1">PMS</h1>
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="text-dark fs-2x mb-3">Welcome, Guest!</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="fw-bold fs-4 text-gray-400 mb-10">You must authorize to use
                        <br />the dashboard.
                    </div>
                    <!--begin::Description-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Illustration-->
            <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-200px min-h-xl-300px mb-xl-10"
                style="background-image: url(assets/media/illustrations/networks.png)"></div>
            <!--end::Illustration-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="flex-row-fluid d-flex flex-center justfiy-content-xl-first p-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center p-15 shadow rounded w-100 w-md-550px mx-auto ms-xl-20">
                <!--begin::Form-->
                <form method="POST" class="form" action="{{route('admin.login')}}">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Sign In</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4">Forgot your password?
                            <a href="#" class="link-primary fw-bolder">Reset here</a>.
                        </div>
                        <!--end::Link-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-dark fs-6">Username</label>
                        <input class="form-control form-control-solid" placeholder="Enter your username" type="text"
                            placeholder="" name="username" autocomplete="off" />
                        @error('username')
                        <div class="fv-plugins-message-container">
                            <div data-field="username" class="fv-help-block">{{ $message}}</div>
                        </div>
                        @enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-7 fv-row" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6">Password</label>
                            <!--end::Label-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-solid" placeholder="Enter yout password"
                                    type="password" placeholder="" name="password" autocomplete="off" />
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>
                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                            </div>
                            @error('password')
                            <div class="fv-plugins-message-container">
                                <div data-field="password" class="fv-help-block">{{ $message}}</div>
                            </div>
                            @enderror
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Row-->
                    <div class="text-center pb-lg-0 pb-8">
                        <button type="submit" class="btn btn-lg btn-primary fw-bolder">
                            <span class="indicator-label">Sign In</span>
                        </button>
                    </div>
                    <!--end::Row-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Right Content-->
    </div>
    <!--end::Authentication - Signup Free Trial-->
</div>
<!--end::Main-->
@endsection
