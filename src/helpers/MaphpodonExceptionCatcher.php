<?php

namespace Maphpodon\helpers;

use Exception;

class MaphpodonExceptionCatcher implements ExceptionCatcher
{
    public function handleException(Exception $exception): void
    {
        throw $exception;
    }
}
