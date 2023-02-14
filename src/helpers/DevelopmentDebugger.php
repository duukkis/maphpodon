<?php

namespace Maphpodon\helpers;

class DevelopmentDebugger implements Debugger
{
    public function __construct(
        public string $pathForParams,
        public string $pathForResponse
    )
    {
    }

    public function debug(string $method, string $url, array $params, string $response): void
    {
        \Safe\file_put_contents(
            sprintf(
                $this->pathForResponse,
                $method,
                str_replace('/', '-', $url)
            ),
            $response
        );
        \Safe\file_put_contents(
            sprintf(
                $this->pathForParams,
                $method,
                str_replace('/', '-', $url)
            ),
            serialize($params)
        );
    }
}
