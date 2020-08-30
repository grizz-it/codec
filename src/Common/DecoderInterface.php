<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Codec\Common;

interface DecoderInterface
{
    /**
     * Decodes data from a format.
     *
     * @param mixed $input The input that should be decoded.
     *
     * @return mixed The decoded data.
     */
    public function decode($input);
}
