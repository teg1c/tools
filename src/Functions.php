<?php

declare(strict_types=1);

namespace Tegic\Tools;

use Closure;

if (!function_exists('collect')) {
    /**
     * Create a collection from the given value.
     */
    function collect(array $value = []): Collection
    {
        return new Collection($value);
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     */
    function value(mixed $value): mixed
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('data_get')) {
    /**
     * Get an item from an array or object using "dot" notation.
     */
    function data_get(mixed $target, array|int|string|null $key, mixed $default = null): mixed
    {
        if (is_null($key)) {
            return $target;
        }

        $key = is_array($key) ? $key : explode('.', is_int($key) ? (string) $key : $key);

        while (!is_null($segment = array_shift($key))) {
            if ('*' === $segment) {
                if ($target instanceof Collection) {
                    $target = $target->all();
                } elseif (!is_array($target)) {
                    return value($default);
                }
                $result = [];
                foreach ($target as $item) {
                    $result[] = data_get($item, $key);
                }

                return in_array('*', $key) ? Arr::collapse($result) : $result;
            }
            if (Arr::accessible($target) && Arr::exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }

        return $target;
    }
}
