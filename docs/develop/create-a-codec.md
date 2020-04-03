# GrizzIT Codec - Create a codec

## Getting started

When creating a new codec it is wise to determine early on, whether or not it
will have shared logic and the size of the `encode` and `decode` methods. The
reason to take this into consideration when creating either a shared class or
choosing to split them up, is simply maintainability and code readability.
When shorter code and/or smaller classes are written, debugging becomes a lot
easier.

After a decision is made whether or not the classes are combined, they need to
be created and should implement either or both [EncoderInterface](../../src/Common/EncoderInterface.php)
and [DecoderInterface](../../src/Common/DecoderInterface.php).

```php
<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace GrizzIt\Codec\Component;

use GrizzIt\Codec\Common\EncoderInterface;
use GrizzIt\Codec\Common\DecoderInterface;

class JsonCodec implements EncoderInterface, DecoderInterface
```
_Start of the JsonCodec class._

## The constructor

When choosing the `__construct` method parameters, keep the native options in
mind of the implementing methods (and keep their defaults in tact). A common
practice in these methods is to set defaults for everything, this is so the
implementation is as "simple" as possible for the implementor. It is advised
to adhere to this same logic when creating a codec. A few questions that jump
to mind are the following, when choosing defaults:
- What does the user expect to happen by default?
- To what standard does the encoded data adhere?
  - A footnote to this point is the following example: JSON calls their
  "arrays with named keys" objects and arrays with numerical values are simply
  arrays. PHP can use both forms for arrays and objects, however JSON does
  not, so it would be logical to choose JSON's example as the leading default.

When these decisions have been made it is time to create and fill in the
`__construct` method:

```php
<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace GrizzIt\Codec\Component;

use GrizzIt\Codec\Common\EncoderInterface;
use GrizzIt\Codec\Common\DecoderInterface;

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
```
_Adding the constructor to the JsonCodec_

## The actual encoding and decoding

When creating the `encode` and `decode` methods keep in mind to make live
easier for the implementing party. Simply returning the result of for example
the `json_decode` method would, in this case, not suffice. The method
`json_decode` does not yield any errors by default, and thus can return an
unexpected value. Looking at the documentation of this method, and focussing on
the return aspect of this method, we can see the following:
```
Returns the value encoded in json in appropriate PHP type. Values true, false and null are returned as TRUE, FALSE and NULL respectively. NULL is returned if the json cannot be decoded or if the encoded data is deeper than the recursion limit.
```

The second sentence is worrysome when expecting a JSON object to be decoded in
a valid manner. Because both `NULL` can be returned from decoding a JSON string
with the contents "`null`" (which is valid) and the same value is returned when
an error occurred. To circumenvent this expected unexpected behaviour, a few
extra checks need to be built in.

Luckily PHP has a method `json_last_error` which returns an integer when and if
an error occurred. Using this method, an `if` statement can be created to catch
this behaviour and return the value or throw an exception.

```php
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
```
_The final implementation of the JsonCodec_

### Sidenote
Yes, it's also possible to pass an argument to the `json_decode` and
`json_encode` method to throw an error when the JSON string is not valid.
However when developing a modular system and keeping the interchangeability in
tact, it is better to use a single type of exception which can be handled by
the implementing side. This package also supplies two exceptions which can be
used for this case:
- [EncodingException](../../src/Exception/EncodingException.php)
- [DecodingException](../../src/Exception/DecodingException.php)

## Further reading

[Back to development index](index.md)

[How it works](how-it-works.md)
