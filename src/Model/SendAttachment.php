<?php

namespace Sendflare\SDK\Model;

/** Attachment content must be a Base64-encoded string without a data URL prefix. */
class SendAttachment
{
    public function __construct(
        public string $filename,
        public string $content,
        public ?string $contentType = null,
        public ?string $contentId = null,
        public ?string $disposition = null
    ) {}

    public function toArray(): array
    {
        $result = ['filename' => $this->filename, 'content' => $this->content];
        foreach (['contentType', 'contentId', 'disposition'] as $key) {
            if ($this->$key !== null && $this->$key !== '') {
                $result[$key] = $this->$key;
            }
        }
        return $result;
    }
}
