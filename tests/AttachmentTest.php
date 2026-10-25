<?php

namespace Sendflare\SDK\Tests;

use PHPUnit\Framework\TestCase;
use Sendflare\SDK\Model\SendAttachment;
use Sendflare\SDK\Model\SendEmailReq;
use Sendflare\SDK\Model\BatchSendEmailReq;

class AttachmentTest extends TestCase
{
    public function testSingleAndBatchAttachments(): void
    {
        $requests = [
            new SendEmailReq('from@example.com', 'to@example.com', 'test', 'body', [], []),
            new BatchSendEmailReq('from@example.com', ['to@example.com'], 'test', 'body', [], [], []),
        ];
        foreach ($requests as $request) {
            $this->assertArrayNotHasKey('attachments', $request->toArray());
            $request->attachments = [
                new SendAttachment('文件.bin', base64_encode("\x00\xff\x01\x80")),
                new SendAttachment('logo.png', 'aGVsbG8=', 'image/png', 'logo', 'inline'),
            ];
            $payload = json_decode(json_encode($request->toArray(), JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
            $this->assertSame([
                ['filename' => '文件.bin', 'content' => 'AP8BgA=='],
                ['filename' => 'logo.png', 'content' => 'aGVsbG8=', 'contentType' => 'image/png', 'contentId' => 'logo', 'disposition' => 'inline'],
            ], $payload['attachments']);
        }
    }
}
