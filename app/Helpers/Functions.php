<?php

use App\Models\Doctor;

function isDoctorActive($email)
{
    $count = Doctor::where('email', $email)
        ->where('is_active', 1)
        ->count();

    if ($count > 0) {
        return true;
    }
    return false;
}
