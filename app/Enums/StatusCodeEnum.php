<?php
namespace App\Enums;

enum StatusCodeEnum
{
    const OK = 200;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const URI_TO_LONG = 414;
}
