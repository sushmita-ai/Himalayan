@section('page-specific-style')
@endsection

<div class="row" data-sticky-container>
    <div class="col-lg-8 col-xl-9">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col">
                        <label>Title
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               placeholder="Enter title" name="title"
                               value="@if(isset($subcategory)){{$subcategory->title}}@else{{old('title')}}@endif"
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
                        <select id="subcategory" class="form-control" name="category_id">Category</select>
                    </div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col">
                        <label>Short Description<span class="text-danger">*</span>
                        </label>
                        <textarea type="text"
                               class="form-control @error('short_description') is-invalid @enderror" placeholder="Enter your short description"
                               name="short_description" value="@if(isset($subcategory)){{$subcategory->short_description}}@else{{old('short_description')}}@endif"
                               required ></textarea>
                        @error('short_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
{{--            <div class="form-group row mt-3">--}}
{{--                <label class="col-xl-12 col-lg-12 col-form-label text-left"> Image</label>--}}
{{--                <input type="file" class="form-control "--}}
{{--                       placeholder="Upload image" name="image">--}}
{{--            </div>--}}
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
                                isset($subcategory->status) ?
                            $subcategory->status : '' )=='active' ? 'checked' :'' }} {{ (old('status')=='on' )
                            ? 'checked' :'' }} />
                        </label>
                    </div>
                    <label class="col-6 ">Feature</label>
                    <div class="col-6">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" name="feature" type="checkbox" {{ old('feature',
                                isset($subcategory->feature) ?
                            $subcategory->feature : '' )=='yes' ? 'checked' :'' }} {{ (old('feature')=='on' )
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
            </div>
        </div>
    </div>
</div>



@section('page-specific-scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#subcategory').select2({
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



    </script>
@endsection

