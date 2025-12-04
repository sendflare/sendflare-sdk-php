<?php

namespace Sendflare\SDK\Model;

/**
 * Get Contact list response entity
 */
class ListContactResp extends PaginateResp
{
    /** @var ContactItem[] */
    public array $data = [];
}

