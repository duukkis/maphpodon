<?php

namespace Maphpodon\helpers;

use Exception;

class DevelopmentExceptionCatcher implements ExceptionCatcher
{
    /**
     * Just a stupid example how this ExceptionCatcher can be used
     * $masto = new Maphpodon(
     *       "mastobotti.eu",
     *       "CLIENT_ID",
     *       "SECRET",
     *       "ALL YOU NEED IS TOKEN",
     *       new DevelopmentExceptionCatcher(),
     *    );
     * @param Exception $exception
     * @return void
     */
    public function handleException(Exception $exception): void
    {
        print_r($exception->getMessage());
        die();
    }
}
