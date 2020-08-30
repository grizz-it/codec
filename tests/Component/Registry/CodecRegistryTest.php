<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Codec\Tests\Component\Registry;

use PHPUnit\Framework\TestCase;
use GrizzIt\Codec\Common\DecoderInterface;
use GrizzIt\Codec\Common\EncoderInterface;
use GrizzIt\Codec\Component\Registry\CodecRegistry;
use GrizzIt\Codec\Exception\CodecNotFoundException;

/**
 * @coversDefaultClass \GrizzIt\Codec\Component\Registry\CodecRegistry
 * @covers \GrizzIt\Codec\Exception\CodecNotFoundException
 */
class CodecRegistryTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::registerEncoder
     * @covers ::getEncoder
     */
    public function testEncoderRegistry(): void
    {
        $subject = new CodecRegistry();
        $encoder = $this->createMock(EncoderInterface::class);
        $subject->registerEncoder('foo', $encoder);
        $this->assertEquals($encoder, $subject->getEncoder('foo'));
        $this->expectException(CodecNotFoundException::class);
        $subject->getEncoder('bar');
    }

    /**
     * @return void
     *
     * @covers ::registerDecoder
     * @covers ::getDecoder
     */
    public function testDecoderRegistry(): void
    {
        $subject = new CodecRegistry();
        $decoder = $this->createMock(DecoderInterface::class);
        $subject->registerDecoder('foo', $decoder);
        $this->assertEquals($decoder, $subject->getDecoder('foo'));
        $this->expectException(CodecNotFoundException::class);
        $subject->getDecoder('bar');
    }
}
