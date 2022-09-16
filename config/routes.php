<?php
    return [
        "contacts" => "contacts/index",
        "doctors" => "doctors/index",
        "doctors/(\d+)" => "doctors/single/$1",
        "departments" => "departments/index",
        "departments/(\d+)" => "departments/single/$1",
        "directions" => "directions/index",
        "directions/(\d+)" => "directions/single/$1",
        "appointment/register" => "appointments/redirect",
        "user/register" => "user/register",
        "user/auth" => "user/auth",
        "user/logout" => "user/logout",
        "appointment" => "appointments/appointmentlist",
        "user/api" => "user/api"
    ]
?>