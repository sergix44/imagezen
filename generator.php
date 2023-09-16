<?php

/*
 * ATTENTION: This file is an insane mess, but it works.
 * It's a quick and dirty way to generate the documentation template for the alterations.
 * It's not meant to be used in any other way than to generate the docs when a new alteration is added.
 * Please, stay away from this file. Or not, I'm not your mom.
 * Feel free to refactor it if you want to.
 */

use SergiX44\ImageZen\DefaultAlterations;
use SergiX44\ImageZen\Image;

const AVOID_OVERWRITE = false;

require __DIR__ . '/vendor/autoload.php';

$imageReflection = new ReflectionClass(Image::class);

$availableMethods = [
    $imageReflection->getMethod('make'),
    $imageReflection->getMethod('canvas'),
    $imageReflection->getMethod('width'),
    $imageReflection->getMethod('height'),
    $imageReflection->getMethod('basePath'),
    $imageReflection->getMethod('filter'),
    $imageReflection->getMethod('save'),
    $imageReflection->getMethod('stream'),
    $imageReflection->getMethod('response'),
    ...(new ReflectionClass(DefaultAlterations::class))?->getMethods(ReflectionMethod::IS_PUBLIC),
    $imageReflection->getMethod('destroy'),
];

/** @var ReflectionMethod $method */
foreach ($availableMethods as $method) {
    $id = $method->getName();

    $file = __DIR__ . "/docs/docs/alterations/$id.md";
    if (file_exists($file) && AVOID_OVERWRITE) {
        return;
    }


    // parse params

    $paramsList = '';
    $params = '';
    /** @var ReflectionParameter $parameter */
    $parameters = $method->getParameters() ?? [];
    foreach ($parameters as $parameter) {
        $paramsList .= "- `{$parameter->getType()} \${$parameter->getName()}`: \n";

        if ($parameter->getType() instanceof ReflectionUnionType) {
            foreach ($parameter->getType()->getTypes() as $type) {
                $params .= $type->getName() . '|';
            }
            $params = rtrim($params, '|');
            $params .= " \${$parameter->getName()}, ";

            continue;
        }

        if ($parameter->isOptional()) {
            $val = $parameter->getDefaultValue() ?? 'null';
            if (enum_exists($parameter->getType()->getName())) {
                $e = new ReflectionEnumBackedCase($parameter->getType()->getName(), $val->name);
                $val = "{$e->getDeclaringClass()->getName()}::{$e->getName()}";
            }

            $params .= "[{$parameter->getType()} \${$parameter->getName()} = {$val}]";
        } else {
            $params .= "{$parameter->getType()} \${$parameter->getName()}";
        }
        if ($parameter !== end($parameters)) {
            $params .= ', ';
        }
    }

    // parse return value

    $returnValue = $method->getReturnType();
    if ($returnValue instanceof ReflectionUnionType) {
        $returnValue = '';
        foreach ($method->getReturnType()->getTypes() as $type) {
            $returnValue .= $type->getName() . '|';
        }
        $returnValue = rtrim($returnValue, '|');
    } else {
        $returnValue = $returnValue?->getName() ?? 'void';
    }

    if ($returnValue === 'self') {
        $parsedReturnValue = 'Instance of `' . Image::class . '`.';
    } elseif ($returnValue === 'void') {
        $parsedReturnValue = '`void`, no return value.';
    } else {
        $parsedReturnValue = "`{$returnValue}`: ";
    }

    $markdown = <<<MARKDOWN
# `$id()`

```
->$id($params): $returnValue
```
## Parameters

$paramsList

## Returns

$parsedReturnValue

## Example

```php
use SergiX44\ImageZen\Image;

\$image = Image::make('path/to/image.jpg')
    ->$id($params);

```

MARKDOWN;

    file_put_contents($file, $markdown);
}
