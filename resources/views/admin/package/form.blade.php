@section('page-specific-style')

@endsection
<div class="row" data-sticky-container>
    <div class="col-12">
        <div class="card card-custom gutter-b example example-compact">
            <!--begin::Card body-->
            <div class="card-body">
<div class="stepper stepper-pills" id="kt_stepper_example_basic">
    <!--begin::Nav-->
    <div class="stepper-nav flex-center flex-wrap mb-10">
        <!--begin::Step 1-->
        <div class="stepper-item mx-2 my-4 current" data-kt-stepper-element="nav">
            <!--begin::Line-->
            <div class="stepper-line w-40px"></div>
            <!--end::Line-->

            <!--begin::Icon-->
            <div class="stepper-icon w-40px h-40px">
                <i class="stepper-check fas fa-check"></i>
                <span class="stepper-number">1</span>
            </div>
            <!--end::Icon-->

            <!--begin::Label-->
            <div class="stepper-label">
                <h3 class="stepper-title">
                    Tour Description
                </h3>

            </div>
            <!--end::Label-->
        </div>
        <!--end::Step 1-->

        <!--begin::Step 2-->
        <div class="stepper-item mx-2 my-4" data-kt-stepper-element="nav">
            <!--begin::Line-->
            <div class="stepper-line w-40px"></div>
            <!--end::Line-->

            <!--begin::Icon-->
            <div class="stepper-icon w-40px h-40px">
                <i class="stepper-check fas fa-check"></i>
                <span class="stepper-number">2</span>
            </div>
            <!--begin::Icon-->

            <!--begin::Label-->
            <div class="stepper-label">
                <h3 class="stepper-title">
                    Gallery
                </h3>

            </div>
            <!--end::Label-->
        </div>
        <!--end::Step 2-->

        <!--begin::Step 3-->
        <div class="stepper-item mx-2 my-4" data-kt-stepper-element="nav">
            <!--begin::Line-->
            <div class="stepper-line w-40px"></div>
            <!--end::Line-->

            <!--begin::Icon-->
            <div class="stepper-icon w-40px h-40px">
                <i class="stepper-check fas fa-check"></i>
                <span class="stepper-number">3</span>
            </div>
            <!--begin::Icon-->

            <!--begin::Label-->
            <div class="stepper-label">
                <h3 class="stepper-title">
                    Itinerary
                </h3>
            </div>
            <!--end::Label-->
        </div>
        <!--end::Step 3-->

        <!--begin::Step 4-->
        <div class="stepper-item mx-2 my-4" data-kt-stepper-element="nav">
            <!--begin::Line-->
            <div class="stepper-line w-40px"></div>
            <!--end::Line-->

            <!--begin::Icon-->
            <div class="stepper-icon w-40px h-40px">
                <i class="stepper-check fas fa-check"></i>
                <span class="stepper-number">4</span>
            </div>
            <!--begin::Icon-->

            <!--begin::Label-->
            <div class="stepper-label">
                <h3 class="stepper-title">
                    Cost Includes
                </h3>
            </div>
            <!--end::Label-->
        </div>
        <!--end::Step 4-->
        <div class="stepper-item mx-2 my-4" data-kt-stepper-element="nav">
            <!--begin::Line-->
            <div class="stepper-line w-40px"></div>
            <!--end::Line-->

            <!--begin::Icon-->
            <div class="stepper-icon w-40px h-40px">
                <i class="stepper-check fas fa-check"></i>
                <span class="stepper-number">5</span>
            </div>
            <!--begin::Icon-->

            <!--begin::Label-->
            <div class="stepper-label">
                <h3 class="stepper-title">
                    Map
                </h3>

            </div>
            <!--end::Label-->
        </div>
    </div>
    <!--end::Nav-->

    <!--begin::Form-->
    <form class="form w-lg-500px mx-auto" novalidate="novalidate" id="kt_stepper_example_basic_form">
        <!--begin::Group-->
        <div class="mb-5">
            <!--begin::Step 1-->
            <div class="flex-column current" data-kt-stepper-element="content">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col">
                            <label>Name
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   placeholder="Enter title" name="title"
                                   value="@if(isset($package)){{$package->title}}@else{{old('title')}}@endif"
                                   required />
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <div class="col">
                            <label>Category</label>
                            <select id="category" class="form-control" name="category_id">Category</select>
                        </div>
                        <div class="col">
                            <label>Sub Category</label>
                            <select id="subcategory" class="form-control" name="subcategory_id">Sub Category</select>
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <div class="col">
                            <label>Short Description<span class="text-danger">*</span>
                            </label>
                            <textarea type="text"
                                      class="form-control @error('short_description') is-invalid @enderror" placeholder="Enter your short_description"
                                      name="short_description" value="@if(isset($package)){{$package->short_description}}@else{{old('short_description')}}@endif"
                            ></textarea>
                            @error('package')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label> Description<span class="text-danger">*</span>
                            </label>
                            <textarea type="longtext"
                                      class="form-control @error('description') is-invalid @enderror" placeholder="Enter description"
                                      name="description" value="@if(isset($package)){{$package->description}}@else{{old('description')}}@endif"
                            ></textarea>
                            @error('package')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    </br>
                    <div class="form-group row mt-5">
                        <div class="col">
                            <label>Meta Title<span class="text-danger">*</span>
                            </label>
                            <textarea type="text"
                                      class="form-control @error('meta_title') is-invalid @enderror" placeholder="Enter your meta_title"
                                      name="meta_title" value="@if(isset($package)){{$package->meta_title}}@else{{old('meta_title')}}@endif"
                            ></textarea>
                            @error('package')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label> Meta Description<span class="text-danger">*</span>
                            </label>
                            <textarea type="longtext"
                                      class="form-control @error('meta_description') is-invalid @enderror" placeholder="Enter description"
                                      name="meta_description" value="@if(isset($package)){{$package->meta_description}}@else{{old('meta_description')}}@endif"
                            ></textarea>
                            @error('package')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    </br>
                    <div class="form-group row-5">
                        <div class="col">
                            <select name="level" id="" class="form-control">
                                <option selected disabled>Select Package Level</option>
                                <option value="beginner" @if(isset($package)){{ $package->level == 'beginner' ? 'selected' : '' }}@else @endif>Beginner</option>
                                <option value="semi-pro" @if(isset($package)){{ $package->level == 'semi-pro' ? 'selected' : '' }} @else @endif>Semi Pro</option>
                                <option value="professional" @if(isset($package)){{ $package->level == 'professional' ? 'selected' : '' }}@else @endif>Professional</option>
                                <option value="legendary" @if(isset($package)){{ $package->level == 'legendary' ? 'selected' : '' }}@else @endif>Legendary</option>
                            </select>
                        </div>
                    </div></br>
                    <div class="form-group row">
                        <div class="col">
                            <label>Price
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                   placeholder="Enter price" name="price"
                                   value="@if(isset($package)){{$package->price}}@else{{old('price')}}@endif"
                                   required />
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label>Offer Price
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('offer_price') is-invalid @enderror"
                                   placeholder="Enter price" name="offer_price"
                                   value="@if(isset($package)){{$package->offer_price}}@else{{old('offer_price')}}@endif"
                                   required />
                            @error('offer_price')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label>Trip Duration
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('trip_duration') is-invalid @enderror"
                                   placeholder="Enter trip duration" name="trip_duration"
                                   value="@if(isset($package)){{$package->trip_duration}}@else{{old('trio_duration')}}@endif"
                                   required />
                            @error('trip_duration')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <br/>
                        <div class="form-group row mt-3">

                            <div class="col">
                                <label >Status</label>
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" name="status" type="checkbox" {{ old('status',
                                isset($package->status) ?
                            $package->status : '' )=='yes' ? 'checked' :'' }} {{ (old('status')=='yes' )
                            ? 'checked' :'' }} />
                                </label>
                            </div>

                            <div class="col">
                                <label>Is_Feature</label>
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" name="feature" type="checkbox" {{ old('feature',
                                isset($package->feature) ?
                            $package->feature : '' )=='yes' ? 'checked' :'' }} {{ (old('feature')=='on' )
                            ? 'checked' :'' }} />
                                </label>
                            </div>
                            <div class="col">
                                <label>Deal</label>
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" name="deal" type="checkbox" {{ old('deal',
                                isset($package->deal) ?
                            $package->deal : '' )=='yes' ? 'checked' :'' }} {{ (old('deal')=='on' )
                            ? 'checked' :'' }} />
                                </label>
                            </div>
                            <div class="col">
                                <label>Trending</label>
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" name="is_trending" type="checkbox" {{ old('is_trending',
                                isset($package->is_trending) ?
                            $package->is_trending : '' )=='yes' ? 'checked' :'' }} {{ (old('is_trending')=='yes' )
                            ? 'checked' :'' }} />
                                </label>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div  data-kt-stepper-element="content">

                @include('admin.package.include.gallery')
            </div>
            <div  data-kt-stepper-element="content">
                <div class="card-body">
                @include('admin.package.include.itinerary')
                </div>
            </div>
            <div  data-kt-stepper-element="content">
                <div class="card-body">
                    @include('admin.package.include.cost')
                </div>
            </div>
            <div  data-kt-stepper-element="content">
               @include('admin.package.include.map')
            </div>


            <!--begin::Step 1-->
            <div class="me-2">
                <button type="button" class="btn btn-light btn-active-light-primary" data-kt-stepper-action="previous"style="position: relative;left:90%;">
                    Back
                </button>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-kt-stepper-action="next" style="position: relative;left:90%;">

                    Continue
                </button>
            </div>
            <!--end::Wrapper-->

            <!--begin::Wrapper-->

            <!--end::Wrapper-->
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
            </div>
        </div>
    </div>
</div>





@section('page-specific-scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{asset('assets/css/style.bundle.js')}}"></script>
    <script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    <script type="text/javascript">
        $('#category').select2({
            placeholder: "Select Category",
            ajax: {
                url: "{{route('admin.category.subcategory')}}",
                dataType: 'json',
                delay:'500',
                processResults: function (data) {
                    return {
                        results: $.map(data, function (subcategory) {
                            return {
                                text: subcategory.title,
                                id: subcategory.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });
        $('#subcategory').select2({
            placeholder: "Select Sub Category",
            ajax: {
                url: "{{route('admin.subcategory.package')}}",
                dataType: 'json',
                delay:'500',
                processResults: function (data) {
                    return {
                        results: $.map(data, function (package) {
                            return {
                                text: package.title,
                                id: package.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });
        $('#kt_docs_repeater_basic').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });





    </script>

    <script>
        var element = document.querySelector("#kt_stepper_example_basic");

        // Initialize Stepper
        var stepper = new KTStepper(element);
        // Handle next step
        stepper.on("kt.stepper.next", function (stepper) {

            stepper.goNext();

            // go next step
        });

        // Handle previous step
        stepper.on("kt.stepper.previous", function (stepper) {
            stepper.goPrevious(); // go previous step
        });
    </script>


@endsection


<!--end::Stepper-->



