<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Codec\Exception;

class CodecNotFoundException extends CodecException
{
    /**
     * Constructor.
     *
     * @param string $key
     * @param string $type
     * @param int $code
     */
    public function __construct(string $key, string $type, int $code = null)
    {
        parent::__construct(
            sprintf('Could not find %s for key: %s', $type, $key),
            $code
        );
    }
}
