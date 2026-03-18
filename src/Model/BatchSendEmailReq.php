<?php

namespace Sendflare\SDK\Model;

/**
 * Batch Send Email request entity
 */
class BatchSendEmailReq
{
    public string $from;
    public array $to;
    public string $subject;
    public string $body;
    public array $cc;
    public array $bcc;

    public function __construct(string $from, array $to, string $subject, string $body, array $cc, array $bcc, array $replyTo)
    {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->replyTo = $replyTo;
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
            'replyTo' => $this->replyTo,
        ];
    }
}

