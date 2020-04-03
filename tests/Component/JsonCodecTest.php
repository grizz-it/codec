<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace GrizzIt\Codec\Tests\Component;

use PHPUnit\Framework\TestCase;
use GrizzIt\Codec\Component\JsonCodec;
use GrizzIt\Codec\Exception\EncodingException;
use GrizzIt\Codec\Exception\DecodingException;

/**
 * @coversDefaultClass \GrizzIt\Codec\Component\JsonCodec
 * @covers \GrizzIt\Codec\Exception\EncodingException
 * @covers \GrizzIt\Codec\Exception\DecodingException
 */
class JsonCodecTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::encode
     * @covers ::__construct
     */
    public function testEncode(): void
    {
        $subject = new JsonCodec(1);

        $this->assertEquals(
            '{"foo":"bar"}',
            $subject->encode(['foo' => 'bar'])
        );

        $this->expectException(EncodingException::class);

        $subject->encode(['foo' => ['bar' => 'baz']]);
    }

    /**
     * @return void
     *
     * @covers ::decode
     * @covers ::__construct
     */
    public function testDecode(): void
    {
        $subject = new JsonCodec(2, 0, 0, true);
        $this->assertEquals(
            ['foo' => 'bar'],
            $subject->decode('{"foo":"bar"}')
        );

        $this->expectException(DecodingException::class);

        $subject->decode('{"foo":{"bar":"baz"}');
    }
}
