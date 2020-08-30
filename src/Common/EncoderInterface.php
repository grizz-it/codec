<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Codec\Common;

interface EncoderInterface
{
    /**
     * Encodes data into a format.
     *
     * @param mixed $input The input that should be encoded.
     *
     * @return mixed The encoded data.
     */
    public function encode($input);
}
