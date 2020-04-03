<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace GrizzIt\Codec\Component;

use GrizzIt\Codec\Common\EncoderInterface;
use GrizzIt\Codec\Common\DecoderInterface;
use GrizzIt\Codec\Exception\EncodingException;
use GrizzIt\Codec\Exception\DecodingException;

class JsonCodec implements EncoderInterface, DecoderInterface
{
    /** @var int */
    private $depth;

    /** @var int */
    private $encodeOptions;

    /** @var int */
    private $decodeOptions;

    /** @var bool */
    private $decodeAssociative;

    /**
     * Constructor
     *
     * @param int $depth
     * @param int $encodeOptions
     * @param int $decodeOptions
     * @param bool $decodeAssociative
     */
    public function __construct(
        int $depth = 512,
        int $encodeOptions = 0,
        int $decodeOptions = 0,
        bool $decodeAssociative = false
    ) {
        $this->depth = $depth;
        $this->encodeOptions = $encodeOptions;
        $this->decodeOptions = $decodeOptions;
        $this->decodeAssociative = $decodeAssociative;
    }

    /**
     * Encodes data into a format.
     *
     * @param mixed $input The input that should be encoded.
     *
     * @return mixed The encoded data.
     *
     * @throws EncodingException When encoding fails.
     */
    public function encode($input)
    {
        $output = json_encode(
            $input,
            $this->encodeOptions,
            $this->depth
        );

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new EncodingException(
                json_last_error_msg(),
                json_last_error()
            );
        }

        return $output;
    }

    /**
     * Decodes data from a format.
     *
     * @param mixed $input The input that should be decoded.
     *
     * @return mixed The decoded data.
     *
     * @throws DecodingException When decoding fails.
     */
    public function decode($input)
    {
        $output = json_decode(
            $input,
            $this->decodeAssociative,
            $this->depth,
            $this->decodeOptions
        );

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new DecodingException(
                json_last_error_msg(),
                json_last_error()
            );
        }

        return $output;
    }
}
