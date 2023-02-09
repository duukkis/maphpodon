<?php

namespace Maphpodon\helpers;

use Exception;

interface ExceptionCatcher
{
    public function handleException(Exception $exception): void;
}
