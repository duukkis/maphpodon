<?php

namespace Maphpodon\helpers;

use function Safe\json_encode;
use function Safe\json_decode;
use function Safe\file_put_contents;

class DevelopmentDebugger implements Debugger
{
    public function __construct(
        public string $pathForParams,
        public string $pathForResponse
    ) {
    }

    public function debug(string $method, string $url, array $params, string $response): void
    {
        $j = json_decode($response);
        file_put_contents(
            sprintf(
                $this->pathForResponse,
                $method,
                str_replace('/', '-', $url)
            ),
            json_encode($j, JSON_PRETTY_PRINT)
        );
        file_put_contents(
            sprintf(
                $this->pathForParams,
                $method,
                str_replace('/', '-', $url)
            ),
            serialize($params)
        );
    }
}
