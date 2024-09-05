# DecoratorBundle

![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/yceruto/decorator-bundle/ci.yml)
![Dynamic JSON Badge](https://img.shields.io/badge/dynamic/json?url=https%3A%2F%2Frepo.packagist.org%2Fp2%2Fyceruto%2Fdecorator.json&query=%24.packages%5B%22yceruto%2Fdecorator-bundle%22%5D%5B0%5D.version&label=version)
![PHP](https://img.shields.io/badge/dynamic/json?url=https%3A%2F%2Fgithub.com%2Fyceruto%2Fdecorator-bundle%2Fraw%2Fmain%2Fcomposer.json&query=require.php&label=php)
![GitHub License](https://img.shields.io/github/license/yceruto/decorator-bundle)
![Downloads](https://img.shields.io/badge/dynamic/json?url=https%3A%2F%2Fpackagist.org%2Fpackages%2Fyceruto%2Fdecorator-bundle.json&query=package.downloads.total&label=downloads)

Symfony framework integration of the [`yceruto/decorator`](https://github.com/yceruto/decorator) library.
 * Enables decoration capabilities for Symfony controllers.

## Installation

Open a command console, enter your project directory and execute:

```console
$ composer require yceruto/decorator-bundle
```

## Available Decorators

### Transactional

A Doctrine ORM decorator that wraps persistence method  operations within 
a single Doctrine transaction. In case you're using multiple entity managers, 
you can pass the name of the entity manager as parameter. 

For example:
```php
class MyController
{
    #[Transactional(name: 'secondary')]
    public function __invoke(Request $request): Response
    {
        // multiple persistence operations...
    }
}
```

## License

This software is published under the [MIT License](LICENSE)
