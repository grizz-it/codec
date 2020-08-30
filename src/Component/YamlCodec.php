<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Codec\Component;

use GrizzIt\Codec\Common\EncoderInterface;
use GrizzIt\Codec\Common\DecoderInterface;
use GrizzIt\Codec\Exception\DecodingException;
use Throwable;

class YamlCodec implements EncoderInterface, DecoderInterface
{
    /** @var int */
    private $encoding;

    /** @var int */
    private $linebreak;

    /** @var callable[] */
    private $encodeCallbacks;

    /** @var int */
    private $decodePosition;

    /** @var callable[] */
    private $decodeCallbacks;

    /** @var int */
    private $nDocs = 0;

    /**
     * Constructor
     *
     * @param int $encoding
     * @param int $linebreak
     * @param callable[] $encodeCallbacks
     * @param int $decodePosition
     * @param callable[] $decodeCallbacks
     */
    public function __construct(
        $encoding = YAML_ANY_ENCODING,
        $linebreak = YAML_ANY_BREAK,
        $encodeCallbacks = [],
        $decodePosition = 0,
        $decodeCallbacks = []
    ) {
        $this->encoding = $encoding;
        $this->linebreak = $linebreak;
        $this->encodeCallbacks = $encodeCallbacks;
        $this->decodePosition = $decodePosition;
        $this->decodeCallbacks = $decodeCallbacks;
    }

    /**
     * Encodes data into a format.
     *
     * @param mixed $input The input that should be encoded.
     *
     * @return mixed The encoded data.
     */
    public function encode($input)
    {
        return yaml_emit(
            $input,
            $this->encoding,
            $this->linebreak,
            $this->encodeCallbacks
        );
    }

    /**
     * Decodes data from a format.
     *
     * @param mixed $input The input that should be decoded.
     *
     * @return mixed The decoded data.
     *
     * @throw DecodingException When decoding fails.
     */
    public function decode($input)
    {
        $nDocs = 0;

        try {
            $output = yaml_parse(
                $input,
                $this->decodePosition,
                $nDocs,
                $this->decodeCallbacks
            );
        } catch (Throwable $exception) {
            throw new DecodingException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }


        $this->nDocs = $nDocs;

        return $output;
    }

    /**
     * Returns the number of docs parsed in the last decode.
     *
     * @return int
     */
    public function getNDocs(): int
    {
        return $this->nDocs;
    }
}
