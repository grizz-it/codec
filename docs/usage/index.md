# GrizzIT Codec - Usage Documentation

This part of the documentation will focus on the usage of this package.

## Dependencies

This package has a dependency on two `ext-` composer packages.
This mean that it is dependent on PHP extensions.

### ext-json
The depedency `ext-json` is a built-in PHP extension which provides the various JSON functions, most importantly `json_encode` and `json_decode`.
Because is bundled with PHP by default, no installation actions are required.

### ext-yaml
The dependency `ext-yaml` is a PHP extension which is not bundled with PHP by default.
For this extension follow the installation instructions provided by PHP [here](https://www.php.net/manual/en/yaml.installation.php).
The extension is installed through PECL, the documentation for that can be found [here](https://www.php.net/manual/en/install.pecl.php).

## Index

- [Main index](../index.md)
- [Using the codecs](using-the-codecs.md)
- [Using the registry](using-the-registry.md)
