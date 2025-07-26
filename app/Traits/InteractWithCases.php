<?php

namespace App\Traits;

use BackedEnum;
use Exception;

trait InteractWithCases
{
    public static function names(): array
    {
        return array_column(static::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(static::cases(), 'value');
    }

    public static function options(): array
    {
        $cases = static::cases();

        return isset($cases[0]) && $cases[0] instanceof BackedEnum
            ? array_column($cases, 'name', 'value')
            : array_column($cases, 'name');
    }

    public function normalCase(): string
    {
        return preg_replace('/(?<!^)([A-Z])/', ' $1', $this->name);
    }

    public static function get($property): array
    {
        $values = [];
        foreach (static::cases() as $case) {
            $values[$case->value] = $case->$property();
        }

        return $values;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'label' => $this->normalCase(),
            'value' => $this->value,
        ];
    }

    /** Return the enum's value when it's $invoked(). */
    public function __invoke()
    {
        return $this instanceof BackedEnum ? $this->value : $this->name;
    }

    /** Return the enum's value or name when it's called ::STATICALLY(). */
    public static function __callStatic($name, $args)
    {
        $cases = static::cases();

        foreach ($cases as $case) {
            if ($case->name === $name) {
                return $case instanceof BackedEnum ? $case->value : $case->name;
            }
        }
        $message = "case: $name is not found in ".static::class;
        throw new Exception($message);
    }
}
