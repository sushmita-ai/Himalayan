@section('page-specific-style')
@endsection

<div class="row" data-sticky-container>
    <div class="col-lg-8 col-xl-9">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col">
                        <label>Subject
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               placeholder="Enter Subject" name="name"
                               value="@if(isset($subject)){{$subject->name}}@else{{old('name')}}@endif"
                               required />

                    </div>

            </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </div>
    </div>
</div>


@section('page-specific-scripts')

@endsection
