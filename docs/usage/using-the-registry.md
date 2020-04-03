# GrizzIT Codec - Using the registry

The registry is used to register encoders and decoders by a key.
These keys can be used by a PHP application to find the correct encoder/decoder to work with data in their respective formats.

The package provides one implementation for registering codecs.

## [CodecRegistry](../../src/Component/Registry/CodecRegistry.php)

The `CodecRegistry` class is an implementation of the [CodecRegistryInterface](../../src/Common/CodecRegistryInterface.php).
This implementation requires no constructor arguments.
It is wise to only instantiate this class once and passing it along through the application.
By doing so, unnecessary instances of the same class are prevented, which could slow down the application.

The instantiation of this class will can be seen in the following snippet:
```php
<?php

use GrizzIt\Codec\Component\Registry\CodecRegistry;

$codecRegistry = new CodecRegistry();
```

### Registering an encoder

To register an encoder on the registry of the previous example,
simply instantiate it and pass it to the `registerEncoder` method with an appropriate key.

```php
<?php
use GrizzIt\Codec\Component\JsonCodec;

$jsonCodec = new JsonCodec();

$codecRegistry->registerEncoder('json', $jsonCodec);
```

### Registering a decoder

Registering a decoder is similar to the previous example,
the only key difference is, that the method which is invoked is the `registerDecoder` method.

### Registering a codec

To register a codec efficiently, register the same instance of the codec to both methods.
By doing so, the same reference will be used and unnecessary instances are prevented.

```php
<?php
use GrizzIt\Codec\Component\JsonCodec;

$jsonCodec = new JsonCodec();

$codecRegistry->registerEncoder('json', $jsonCodec);
$codecRegistry->registerDecoder('json', $jsonCodec);
```

### Retrieving an encoder/decoder

To retrieve an instance of an encoder and/or decoder,
the method `getEncoder` or `getDecoder` can be invoked with
the key that was used to register them.

```php
<?php
$encoder = $codecRegistry->getEncoder('json');
$decoder = $codecRegistry->getDecoder('json');
```

#### Note

The previous example would yield the same instance on both variables.
However never assume in your code that this is the case,
because the instance can be altered by another mechanic within your application.
This might yield an instance which would not be able to fulfill both needs.

## Further reading

[Back to usage index](index.md)

[Using the codecs](using-the-codecs.md)
