<?php

namespace Maphpodon\helpers;

interface Debugger
{
    public function debug(string $method, string $url, array $params, string $response): void;
}
