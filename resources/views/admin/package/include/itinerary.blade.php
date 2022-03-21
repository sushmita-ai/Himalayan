

<div class="row" data-sticky-container>
    <div class="col-lg-8 col-xl-9">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col">
                        <label>Title
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('itinerary_title') is-invalid @enderror"
                               placeholder="Enter title" name="itinerary_title"
                               value="@if(isset($itinerary)){{$itinerary->itinerary_title}}@else{{old('itinerary_title')}}@endif"
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
                        <label>Itinerary Description<span class="text-danger">*</span>
                        </label>
                        <textarea type="longtext"
                                  class="form-control @error('itinerary_description') is-invalid @enderror" placeholder="Enter description"
                                  name="itinerary_description" value="@if(isset($itinerary)){{$itinerary->itinerary_description}}@else{{old('itinerary_description')}}@endif"
                                  required ></textarea>
                        @error('package')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                </br>

            </div>
        </div>

    </div>
</div>
