# GrizzIT Codec - How it works

## Codec

The codec components are simple encoding and decoding classes, which usually
don't contain a lot of internal logic and mostly work as an abstraction layer
for internal methods.

## Registry

Components do not have to implement both interfaces, but they must be registered
correctly when doing so in the [CodecRegistry](../../src/Common/CodecRegistryInterface.php).
When registering an encoder or decoder a common keyword should be used for the
specific use case. It is advised to use the most commonly used keyword, e.g.:
For JSON encoders and decoders it would simply be the `json` keyword.

### Registry advice

For YAML encoders and decoders multiple common spelling styles (and file extensions).
In this case, it's advised to use the longest, short spelling of the type, so `yaml`.
When basing this decision on the file extension, it's possible to add a translation
for example through the `grizz-it/translator` package.

## Further reading

[Back to development index](index.md)

[Create a codec](create-a-codec.md)
