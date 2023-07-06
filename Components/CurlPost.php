<?php

namespace testTask\Components;

use RuntimeException;

readonly class CurlPost
{
    public function __construct(
        private string $url,
        private array $options = [],
    ) {}

    public function __invoke(array $post): string
    {
        $ch = curl_init($this->url);
        foreach ($this->options as $key => $val) {
            curl_setopt($ch, $key, $val);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $errno = curl_errno($ch);

        if (is_resource($ch)) {
            curl_close($ch);
        }
        if (0 !== $errno) {
            throw new RuntimeException($error, $errno);
        }

        return $response;
    }
}