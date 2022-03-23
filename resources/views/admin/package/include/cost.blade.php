
<div class="form-group row mt-5">

    <div class="col">
        <label>Cost Exclude<span class="text-danger">*</span>
        </label>
        <textarea type="longtext"
                  class="form-control @error('cost_excludes') is-invalid @enderror" placeholder="Enter description"
                  name="cost_excludes" value="@if(isset($package)){{$package->cost_excludes}}@else{{old('cost_excludes')}}@endif"
                  ></textarea>
        @error('package')
        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
        @enderror
    </div>
</div>



<div class="form-group row mt-5">

    <div class="col">
        <label>Cost Include<span class="text-danger">*</span>
        </label>
        <textarea type="longtext"
                  class="form-control @error('cost_includes') is-invalid @enderror" placeholder="Enter description"
                  name="cost_includes" value="@if(isset($package)){{$package->cost_includes}}@else{{old('cost_includes')}}@endif"
                  ></textarea>
        @error('package')
        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
        @enderror
    </div>
</div>
<br/>

