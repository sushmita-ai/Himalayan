<div class="container-fluid">
    @if (!isset($employee) && !isset($error))
    <div style="display:grid;">
        <img class="h-200px w-300px m-auto" src="{{asset('assets/icons/search.svg')}}" alt="search_icon">
        <div class="m-auto text-muted"> Search result for employee...</div>
    </div>
    @endif

    @if (isset($error))
    <div style="display:grid;">
        <img class="h-200px w-300px m-auto" src="{{asset('assets/icons/error.svg')}}" alt="search_icon">
        <div class="m-auto text-muted"> {{$error}}</div>
    </div>
    @endif

    @if (isset($employee))
    <div class="text-muted mb-2">Employee Data</div>
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="col">
            Employee Name: {{$employee->first_name . ' ' . $employee->last_name}}
        </div>

        @if ($attendance->count() == 0)
        <div class="col">
            <div class="col d-flex">
                <button onclick="createAttendance({{$employee->id}},  {{isset($code)? $code : null}})"
                    class="btn btn-success btn-sm ms-auto">Check
                    in</button>
            </div>
        </div>
        @endif

    </div>

    <div class="text-muted mb-2">Parking Data</div>
    @if ($attendance->count() > 0)
    @foreach ($attendance as $item)
    <?php
    $end_time = \Carbon\Carbon::now();
    ?>
    <div class="d-flex justify-content-between align-items-center mt-1">
        <div class="col ">
            Start time: {{$item->start_time}}
        </div>
        @if ($item->end_time == null)
        <div class="col">
            End Time: -
        </div>
        <div class="col d-flex">
            <button onclick="proccessCheckout({{$item->id}}, '{{$end_time}}', {{isset($code)? $code: null}})"
                class="btn btn-success btn-sm ms-auto">check out</button>
        </div>
        @else
        <div class="col">
            End Time: {{$item->end_time}}
        </div>
        <div class="text-success"><i class="fas fa-check text-success me-2"></i>checked out</div>
        @endif

    </div>
    @endforeach
    @else
    <div class="text-muted">No Active Attendance found...</div>
    @endif

    @endif
    <!-- customer isset check ends -->

    {{-- <div class="col">
        Total: Rs {{$price}}
    </div> --}}


</div>