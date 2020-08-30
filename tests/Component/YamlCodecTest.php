<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Codec\Tests\Component;

use PHPUnit\Framework\TestCase;
use GrizzIt\Codec\Component\YamlCodec;
use GrizzIt\Codec\Exception\DecodingException;

/**
 * @coversDefaultClass \GrizzIt\Codec\Component\YamlCodec
 * @covers \GrizzIt\Codec\Exception\DecodingException
 */
class YamlCodecTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::encode
     * @covers ::__construct
     */
    public function testEncode(): void
    {
        $subject = new YamlCodec();

        $this->assertEquals(
            "---\nfoo: bar\n...\n",
            $subject->encode(['foo' => 'bar'])
        );
    }

    /**
     * @return void
     *
     * @covers ::decode
     * @covers ::__construct
     * @covers ::getNDocs
     */
    public function testDecode(): void
    {
        $subject = new YamlCodec();
        $this->assertEquals(
            ['foo' => 'bar'],
            $subject->decode('foo: bar')
        );

        $this->assertEquals(1, $subject->getNDocs());

        $this->expectException(DecodingException::class);

        $subject->decode('foo: foo: foo');
    }
}
