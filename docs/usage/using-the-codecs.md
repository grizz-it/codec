# GrizzIT Codec - Using the codecs

The codec components are used to encode and decode files.
They can be separated into two different types: encoders, and decoders.

## Definition

Encoders are defined by the usage of the [EncoderInterface](../../src/Common/EncoderInterface.php).
The encoders can encode data from their internal application types to strings.
The output of the encoder could for example be used to store encoded data in a file.

Decoders are defined by the usage of the [DecoderInterface](../../src/Common/DecoderInterface.php).
The decoders can decode data from the aforementioned file back to the internal type, so it can be used by the application again.

If a class supports both interfaces, then it is called a codec.

## [JsonCodec](../../src/Component/JsonCodec.php)

This class provides an encoder and decoder in one implementation. In the constructor, additional options can be configured.

A simple encode/decode example is given in the following snippet:
```php
<?php

use GrizzIt\Codec\Component\JsonCodec;

$jsonCodec = new JsonCodec();

// {"foo": "bar"}
$encoded = $jsonCodec->encode(['foo' => 'bar']);

// ['foo' => 'bar']
$decoded = $jsonCodec->decode($encoded);
```

## [YamlCodec](../../src/Component/YamlCodec.php)

This class provides an encoder and decoder in one implementation. In the constructor, additional options can be configured.

A simple encode/decode example is given in the following snippet:
```php
<?php

use GrizzIt\Codec\Component\YamlCodec;

$yamlCodec = new YamlCodec();

// foo: bar
$encoded = $yamlCodec->encode(['foo' => 'bar']);

// ['foo' => 'bar']
$decoded = $yamlCodec->decode($encoded);
```

## Further reading

[Back to usage index](index.md)

[Using the registry](using-the-registry.md)
