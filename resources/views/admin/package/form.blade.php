@section('page-specific-style')

@endsection

<div class="row" data-sticky-container>
    <div class="col-lg-8 col-xl-9">
        <div class="card card-custom gutter-b example example-compact">
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
                <div class="form-group row">
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
                                isset($package->status) ?
                            $package->status : '' )=='yes' ? 'checked' :'' }} {{ (old('status')=='yes' )
                            ? 'checked' :'' }} />
                        </label>
                    </div>
                    <label class="col-6 ">Feature</label>
                    <div class="col-6">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" name="feature" type="checkbox" {{ old('feature',
                                isset($package->feature) ?
                            $package->feature : '' )=='yes' ? 'checked' :'' }} {{ (old('feature')=='on' )
                            ? 'checked' :'' }} />
                        </label>
                    </div>
                    <label class="col-6 ">Trending</label>
                    <div class="col-6">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" name="is_trending" type="checkbox" {{ old('is_trending',
                                isset($package->is_trending) ?
                            $package->is_trending : '' )=='yes' ? 'checked' :'' }} {{ (old('is_trending')=='yes' )
                            ? 'checked' :'' }} />
                        </label>
                    </div>
                </div>
                    <div class="col-lg-6 col-xl-12">
                        <div class="card card-custom sticky" data-sticky="true" data-margin-top="150" data-sticky-for="1023"
                             data-sticky-class="stickyjs">
                            <div class="card-body">
                                <div class="form-group row mt-3">
                                    <label class="col-xl-12 col-lg-12 col-form-label text-left"> Image</label>
                                    <input type="file" class="form-control "
                                           placeholder="Upload image" name="image">
                                    </div>
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


    </script>
@endsection

