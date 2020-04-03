<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace GrizzIt\Codec\Common;

interface CodecRegistryInterface
{
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
    ): void;

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
    ): void;

    /**
     * Retrieves an encoder by a key.
     *
     * @param string $key
     *
     * @return EncoderInterface
     */
    public function getEncoder(string $key): EncoderInterface;

    /**
     * Retrieves a decoder by a key.
     *
     * @param string $key
     *
     * @return DecoderInterface
     */
    public function getDecoder(string $key): DecoderInterface;
}
