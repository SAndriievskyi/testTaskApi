<?php

namespace testTask\Components\Message;

use testTask\Components\Message\Transports\Console;
use testTask\Components\Message\Transports\EmailInterface;
use testTask\Components\Message\Transports\SmsInterface;
use testTask\Components\Message\Transports\ThirdPartyProvider\Config;
use testTask\Components\Message\Transports\ThirdPartyProvider\Transport;

class TransportFactory
{
    private array $transports = [];

    private array $smsTransports = [
        Console::class,
        [
            'class' => Transport::class,
            'config' => Config::class,
        ],
    ];

    private array $emailTransports = [
        Console::class,
        [
            'class' => Transport::class,
            'config' => Config::class,
        ],
    ];

    /**
     * @return SmsInterface[]
     */
    public function createSmsTransports(): array
    {
        $transports = [];
        foreach ($this->smsTransports as $transport) {
            $transports[] = $this->createTransport($transport);
        }

        return $transports;
    }

    /**
     * @return EmailInterface[]
     */
    public function createEmailTransports(): array
    {
        $transports = [];
        foreach ($this->emailTransports as $transport) {
            $transports[] = $this->createTransport($transport);
        }

        return $transports;
    }

    private function createTransport(array|string $transportConfig)
    {
        $className = $transportConfig['class'] ?? $transportConfig;
        $config = $transportConfig['config'] ?? null;
        if (isset($this->transports[$className])) {
            return $this->transports[$className];
        }

        $transport = new $className($config ? new $config() : null);
        $this->transports[$className] = $transport;

        return $transport;
    }
}