<?php

namespace App\Core\Enums;

use ReflectionClass;

/**
 * Class Enum.
 *
 * @package App\Core\Enums
 * @author Henry Harris <henry@104101110114121.com>
 */
abstract class Enum
{
    /**
     * Get all enumerables (constants) from this Enum.
     *
     * @return array
     */
    public static function getConstants()
    {
        $self = new ReflectionClass(static::class);

        return $self->getConstants();
    }

    /**
     * Get the value of a single constant.
     *
     * @param $constant
     *
     * @return mixed
     */
    public static function getConstant($constant)
    {
        $self = new ReflectionClass(static::class);

        return $self->getConstant($constant);
    }

    /**
     * Check weather the value is part of this enum.
     *
     * @param $value
     *
     * @return bool
     */
    public static function isValueValid($value)
    {
        return in_array($value, self::getConstants());
    }

    /**
     * Returns the values as a laravel validation rule.
     *
     * @return string
     */
    public static function validationRule()
    {
        return 'in:'. implode(',', static::getConstants());
    }
}
