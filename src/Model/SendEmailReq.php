<?php

namespace Sendflare\SDK\Model;

/**
 * Send Email request entity
 */
class SendEmailReq
{
    public string $from;
    public string $to;
    public string $subject;
    public string $body;
    public array $cc;
    public array $bcc;

    public function __construct(string $from, string $to, string $subject, string $body, array $cc, array $bcc)
    {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
        $this->cc = $cc;
        $this->bcc = $bcc;
    }

    public function toArray(): array
    {
        return [
            'from' => $this->from,
            'to' => $this->to,
            'subject' => $this->subject,
            'body' => $this->body,
            'cc' => $this->cc,
            'bcc' => $this->bcc,
        ];
    }
}

