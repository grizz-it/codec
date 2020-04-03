<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace GrizzIt\Codec\Exception;

class DecodingException extends CodecException
{
    /**
     * Constructor.
     *
     * @param string $reason
     * @param int $code
     */
    public function __construct(string $reason, int $code = null)
    {
        parent::__construct(sprintf('Could not decode: %s', $reason), $code);
    }
}
