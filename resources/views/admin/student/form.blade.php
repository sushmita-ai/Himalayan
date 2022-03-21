@section('page-specific-style')
@endsection

<div class="row" data-sticky-container>
    <div class="col-lg-8 col-xl-9">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col">
                        <label>Student Name
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               placeholder="Enter Your Name" name="name"
                               value="@if(isset($student)){{$student->name}}@else{{old('name')}}@endif"
                               required />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col">
                        <label>Subject</label>
                        <select id="student" class="form-control" name="subject_id">Subject</select>
                    </div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col">
                        <label>Roll<span class="text-danger">*</span>
                        </label>
                        <input type="number" data-parsley-type="digits"
                               class="form-control @error('roll') is-invalid @enderror" placeholder="Enter your rollnumber"
                               name="roll" value="@if(isset($student)){{$student->roll}}@else{{old('roll')}}@endif"
                               required />
                        @error('roll')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
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
                <div class="form-group row mt-5">
                    <label class="col-xl-12 col-lg-12 col-form-label text-left"> Image</label>
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
                            <div class="image-input-wrapper w-125px h-125px" @if(isset($student->image))
                            style="background-image:url({{asset($student->image_path) }})"
                                 @else
                                 style="background-image: url({{asset('assets/media/svg/avatars/007-boy-2.svg')}})"
                                @endif></div>
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
                        </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#student').select2({
            placeholder: "Select Subject",
            ajax: {
                url: "{{route('admin.student.subject')}}",
                dataType: 'json',
                delay:'500',
                processResults: function (data) {
                    return {
                        results: $.map(data, function (student) {
                            return {
                                text: student.name,
                                id: student.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });



    </script>
@endsection

