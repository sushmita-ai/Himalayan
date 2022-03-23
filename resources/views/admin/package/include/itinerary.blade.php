<!--begin::Repeater-->
<div id="kt_docs_repeater_basic" xmlns="http://www.w3.org/1999/html">
    <!--begin::Form group-->
    <div class="form-group">
        <div data-repeater-list="kt_docs_repeater_basic">
            <div data-repeater-item>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Itinerary Title
                            <span class="text-danger">*</span>
                        </label>
                        <textarea type="text" class="form-control @error('itinerary title') is-invalid @enderror"
                               placeholder="Enter itinerary title" name="itinerary_title"
                               value="@if(isset($itineraries)){{$itineraries->itinerary_title}}@else{{old('itinerary_title')}}@endif"
                               ></textarea>
                        @error('itineraries')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-5">
                        <lable>Itinerary Description  <span class="text-danger">*</span></lable>
                            <textarea type="text" class="form-control @error('itinerary_description') is-invalid @enderror"
                                   placeholder="Enter itinerary_description" name="itinerary_description"
                                      value="@if(isset($itineraries)){{$itineraries->itinerary_description}}@else{{old('itinerary_description')}}@endif"></textarea>
                            @error('itineraries')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    <div class="col-md-4">
                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                            <i class="la la-trash-o"></i>Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group mt-5">
        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
            <i class="la la-plus"></i>Add
        </a>
    </div>
    <!--end::Form group-->
</div>
<!--end::Repeater-->
