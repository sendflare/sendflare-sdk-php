<?php

namespace Sendflare\SDK\Model;

/**
 * Delete a contact request entity
 */
class DeleteContactReq
{
    public string $emailAddress;
    public string $appId;

    public function __construct(string $emailAddress, string $appId)
    {
        $this->emailAddress = $emailAddress;
        $this->appId = $appId;
    }
}

