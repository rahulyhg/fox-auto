<?php


namespace Fox\Services;

use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\Error;
use \Fox\Core\Exceptions\NotFound;

class AuthToken extends Record
{
    protected $internalAttributeList = ['hash', 'token'];
}

