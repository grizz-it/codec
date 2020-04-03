<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace GrizzIt\Codec\Component\Registry;

use GrizzIt\Codec\Common\DecoderInterface;
use GrizzIt\Codec\Common\EncoderInterface;
use GrizzIt\Codec\Common\CodecRegistryInterface;
use GrizzIt\Codec\Exception\CodecNotFoundException;

class CodecRegistry implements CodecRegistryInterface
{
    /**
     * Contains the registered encoders.
     *
     * @var EncoderInterface[]
     */
    private $encoders = [];

    /**
     * Contains the registered decoders.
     *
     * @var DecoderInterface[]
     */
    private $decoders = [];

    /**
     * Register an encoder.
     *
     * @param string $key
     * @param EncoderInterface $encoder
     *
     * @return void
     */
    public function registerEncoder(
        string $key,
        EncoderInterface $encoder
    ): void {
        $this->encoders[$key] = $encoder;
    }

    /**
     * Register a decoder.
     *
     * @param string $key
     * @param DecoderInterface $decoder
     *
     * @return void
     */
    public function registerDecoder(
        string $key,
        DecoderInterface $decoder
    ): void {
        $this->decoders[$key] = $decoder;
    }

    /**
     * Retrieves an encoder by a key.
     *
     * @param string $key
     *
     * @return EncoderInterface
     *
     * @throws CodecNotFoundException When the requested codec is not registered.
     */
    public function getEncoder(string $key): EncoderInterface
    {
        if (isset($this->encoders[$key])) {
            return $this->encoders[$key];
        }

        throw new CodecNotFoundException($key, 'encoder');
    }

    /**
     * Retrieves a decoder by a key.
     *
     * @param string $key
     *
     * @return DecoderInterface
     *
     * @throws CodecNotFoundException When the requested codec is not registered.
     */
    public function getDecoder(string $key): DecoderInterface
    {
        if (isset($this->decoders[$key])) {
            return $this->decoders[$key];
        }

        throw new CodecNotFoundException($key, 'decoder');
    }
}
