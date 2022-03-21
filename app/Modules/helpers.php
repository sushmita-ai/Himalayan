<?php

use \App\Modules\Models\Attendance;
use \App\Modules\Models\Employee;
use Carbon\Carbon;

//randon number of given length.
function randomNumber($length)
{
    $result = '';

    for ($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

// function getEmployeeReference()
// {
//     $latest
// }

function getLabel($status)
{
    $label = '';
    switch ($status) {
        case 'yes':
            $label = 'badge font-weight-bold badge-light-success badge-inline';
            break;

        case 'no':
            $label = 'badge font-weight-bold badge-light-danger badge-inline';
            break;

        case 'active':
            $label = 'badge font-weight-bold badge-light-success badge-inline';
            break;

        case 'in_active':
            $label = 'badge font-weight-bold badge-light-danger badge-inline';
            break;

        case 'visible':
            $label = 'badge font-weight-bold badge-light-success badge-inline';
            break;

        case 'invisible':
            $label = 'badge font-weight-bold badge-light-danger badge-inline';
            break;

        case 'available':
            $label = 'badge font-weight-bold badge-light-success badge-inline';
            break;

        case 'not_available':
            $label = 'badge font-weight-bold badge-light-danger badge-inline';
            break;

        case 'unpaid':
            $label = 'badge font-weight-bold badge-light-danger badge-inline';
            break;

        case 'draft':
            $label = 'badge font-weight-bold badge-light-info badge-inline';
            break;

        case 'paid':
            $label = 'badge font-weight-bold badge-light-success badge-inline';
            break;

        case 'pending':
            $label = 'badge font-weight-bold badge-light-primary badge-inline';
            break;

        case 'running':
            $label = 'badge font-weight-bold badge-light-info badge-inline';
            break;

        case 'cancelled':
            $label = 'badge font-weight-bold badge-light-danger badge-inline';
            break;

        case 'completed':
            $label = 'badge font-weight-bold badge-light-success badge-inline';
            break;
    }

    return $label;
}

function getStatusIcons($status)
{

    $label = '';
    switch ($status) {
        case 'Active':
            $label = 'check';
            break;

        case 'Inactive':
            $label = 'times';
            break;

        case 'yes':
            $label = 'check';
            break;

        case 'no':
            $label = 'times';
            break;

        case 'visible':
            $label = 'visibility';
            break;

        case 'invisible':
            $label = 'visibility_off';
            break;

        case 'available':
            $label = 'label label-success';
            break;

        case 'not_available':
            $label = 'label label-danger';
            break;
    }

    return $label;
}


function prettyDate($data)
{
    return date('d M Y', strtotime($data));
}

function defaultDateFormat($date, $format = 'Y-m-d')
{
    if ($date == '0000-00-00' || empty($date))
        return '-';

    return date($format, strtotime($date));
}

function getTableHtml($object, $type, $editRoute = null, $deleteRoute = null, $showRoute = null, $optionalMenuRoute = null, $optionalMenuText = null, $optional2MenuRoute = null, $optional2MenuText = null, $uploadRoute = null, $details = null, $switch = null)
{
    switch ($type) {
        case 'visibility':
            return '<span class="' . getLabel($object->visibility) . '">' . $object->visibility_text . '</span>';
            break;
        case 'availability':
            return '<span class="' . getLabel($object->availability) . ' availability-label" data-id="' . $object->id . '">' . $object->availability_text . '</span>';
            break;
        case 'has_subcategory':
            return '<span data-uk-tooltip title="' . $object->has_subcategory_text . '" class="' . getLabel($object->has_subcategory) . '"><i class="material-icons" style="color: white;">' . getStatusIcons($object->has_subcategory) . '</i></span>';
            break;
        case 'job_types':
            return '<span class="label">' . $object->jobtypes->name . '</span>';
            break;
        case 'position':
            return '<span class="label">' . $object->positions->name . '</span>';
            break;
        case 'status':
            return '<label data-uk-tooltip title="' . $object->status_text . '" class="' . getLabel($object->status) . '">' . ucwords($object->status_text) . '</label>';
            break;
        case 'status2':
            return '<label data-uk-tooltip title="' . $object->status_text . '" class="btn ' . getLabel($object->status) . '">' . ucwords($object->status_text) . '</label>';
            break;
        case 'feature':
            return '<label data-uk-tooltip title="' . $object->feature_text . '" class="btn ' . getLabel($object->feature) . '">' . ucwords($object->feature_text) . '</label>';
            break;
        case 'paid':
            if ($object->status == 'active') {
                return '<label data-uk-tooltip title="' . $object->status_text . '" class="' . getLabel($object->status) . '">' . ucwords($object->paid_text) . '</label>';
            }
            return '<a  href="' . route("admin.transaction.paid", $object->id) . '"><label style="cursor:pointer" data-uk-tooltip title="' . $object->status_text . '" class="' . getLabel($object->status) . '">' . ucwords($object->paid_text) . '</label></a>';
            break;
        case 'is_verified':
            return '<span data-uk-tooltip title="' . $object->is_verified . '" class="' . getLabel($object->is_verified) . '">' . $object->is_verified . '</span>';
            break;
        case 'created_by':
            if (str_contains($object->creator->thumbnail_path, '.')) {
                return '<span class=""><a href="' . route('user-detail.index', $object->creator->slug) . '" class="user_action_image">
                    <img data-uk-tooltip title="' . $object->creator->full_name . '" class="md-user-image " src=' . asset($object->creator->thumbnail_path) . ' alt=""/></a>';
                break;
            } else {
                return '<span class=""><a href="' . route('user-detail.index', $object->creator->slug) . '" class="user_action_image">
                    <img data-uk-tooltip title="' . $object->creator->full_name . '" class="md-user-image " src=' . asset('resources/assets/img/avatars/user.png') . ' alt=""/></a>';
                break;
            }

        case 'associated_user':
            if (!empty($object->user->id)) {
                return '<a href="' . route('user-detail.show', $object->user->id) . '" class="user_action_image">
                    <img data-uk-tooltip title="' . $object->user->full_name . '" class="md-user-image " src=' . asset($object->user->thumbnail_path) . ' alt=""/>
                    </a>';
            } else {
                return '<a href="#" class="user_action_image">
                    <img class="md-user-image" src=' . asset("resources/admin/img/user.png") . ' alt=""/>
                    </a>';
            }
        case 'actions':
            return view('admin.general.table-actions', compact('object', 'editRoute', 'deleteRoute', 'showRoute', 'uploadRoute', 'optionalMenuRoute', 'optionalMenuText', 'optional2MenuRoute', 'optional2MenuText', 'details', 'switch'));
            break;

        case 'image':
            return view('admin.general.lightbox', compact('object'));
            break;
        case 'insurance':
            return '<div class="d-flex align-items-center">
                <a href="' . asset($object->insurance_path) . '" data-toggle="lightbox" data-gallery="example-gallery">
                    <div class="symbol symbol-50 flex-shrink-0">
                        <img src="' . asset($object->insurance_path) . '" alt="photo">
                    </div>
                </a>
            </div>';
            break;
        case 'bluebook':
            return '<div class="d-flex align-items-center">
                <a href="' . asset($object->bluebook_path) . '" data-toggle="lightbox" data-gallery="example-gallery">
                    <div class="symbol symbol-50 flex-shrink-0">
                        <img src="' . asset($object->bluebook_path) . '" alt="photo">
                    </div>
                </a>
            </div>';
            break;
        case 'roles':
            $role = '';
            foreach ($object->roles as $k => $v) {
                $role = $role . ' <span class="label label-success">' . $v->display_name . '</span>';
            }
            return $role;
            break;

        case 'username':
            $username = '<a href="' . route('user-detail.show', $object->slug) . '">' . $object->username . '</a>';
            return $username;
            break;

        case 'user_name':
            if (!empty($object->user->id)) {
                $username = '<a href="' . route('user-detail.index', $object->user->id) . '">' . $object->user->full_name . '</a>';
                return $username;
            } else {
                return "N/A";
            }
            break;
    }
}

function getParkingCost(Parking $parking)
{
    $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $parking->start_time);
    $end_time = Carbon::now();

    if ($parking->end_time != null) {
        $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $parking->end_time);
    }

    $total_hrs = $start_time->floatDiffInHours($end_time, false);
    if ($total_hrs > 0) {
        if ($parking->type == 'car') {
            return number_format($total_hrs * 40, 2);
        } else if ($parking->type == 'bike') {
            return number_format($total_hrs * 20, 2);
        }
    }


    return 0;
}
