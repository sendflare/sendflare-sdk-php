<?php

namespace Sendflare\SDK\Model;

/**
 * Save contact request entity
 */
class SaveContactReq
{
    public string $appId;
    public string $emailAddress;
    public ?array $data = null;

    public function __construct(string $appId, string $emailAddress, ?array $data = null)
    {
        $this->appId = $appId;
        $this->emailAddress = $emailAddress;
        $this->data = $data;
    }

    public function toArray(): array
    {
        $result = [
            'appId' => $this->appId,
            'emailAddress' => $this->emailAddress,
        ];

        if ($this->data !== null) {
            $result['data'] = $this->data;
        }

        return $result;
    }
}

