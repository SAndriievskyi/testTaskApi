<?php

namespace testTask\Components\Message\Transports\ThirdPartyProvider;

readonly class Config
{
    public function __construct(
        private string $url = 'https://someUrl.com',
        private string $accessToken = '856739486hgkfjdhkgj',
    ) {}

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}