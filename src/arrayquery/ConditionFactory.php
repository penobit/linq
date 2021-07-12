<?php

namespace Penobit\ArrayQuery;

final class ConditionFactory {
    /**
     * Simple equals.
     *
     * @return bool
     */
    public static function equal($value, $comparable) {
        return $value === $comparable;
    }

    /**
     * Strict equals.
     *
     * @return bool
     */
    public static function strictEqual($value, $comparable) {
        return $value === $comparable;
    }

    /**
     * Simple not equal.
     *
     * @return bool
     */
    public static function notEqual($value, $comparable) {
        return $value !== $comparable;
    }

    /**
     * Strict not equal.
     *
     * @return bool
     */
    public static function strictNotEqual($value, $comparable) {
        return $value !== $comparable;
    }

    /**
     * Strict greater than.
     *
     * @return bool
     */
    public static function greaterThan($value, $comparable) {
        return $value > $comparable;
    }

    /**
     * Strict less than.
     *
     * @return bool
     */
    public static function lessThan($value, $comparable) {
        return $value < $comparable;
    }

    /**
     * Greater or equal.
     *
     * @return bool
     */
    public static function greaterThanOrEqual($value, $comparable) {
        return $value >= $comparable;
    }

    /**
     * Less or equal.
     *
     * @return bool
     */
    public static function lessThanOrEqual($value, $comparable) {
        return $value <= $comparable;
    }

    /**
     * In array.
     *
     * @param array $comparable
     *
     * @return bool
     */
    public static function in($value, $comparable) {
        return \is_array($comparable) && \in_array($value, $comparable, true);
    }

    /**
     * Not in array.
     *
     * @param array $comparable
     *
     * @return bool
     */
    public static function notIn($value, $comparable) {
        return \is_array($comparable) && !\in_array($value, $comparable, true);
    }

    public static function inArray($value, $comparable) {
        if (!\is_array($value)) {
            return false;
        }

        return \in_array($comparable, $value, true);
    }

    public static function inNotArray($value, $comparable) {
        return !static::inArray($value, $comparable);
    }

    /**
     * Is null equal.
     *
     * @return bool
     */
    public static function isNull($value, $comparable) {
        return null === $value;
    }

    /**
     * Is not null equal.
     *
     * @return bool
     */
    public static function isNotNull($value, $comparable) {
        return !$value instanceof KeyNotExists && null !== $value;
    }

    public static function notExists($value, $comparable) {
        return $value instanceof KeyNotExists;
    }

    public static function exists($value, $comparable) {
        return !static::notExists($value, $comparable);
    }

    /**
     * Start With.
     *
     * @param string $comparable
     *
     * @return bool
     */
    public static function startWith($value, $comparable) {
        if (\is_array($comparable) || \is_array($value) || \is_object($comparable) || \is_object($value)) {
            return false;
        }

        if (preg_match("/^{$comparable}/", $value)) {
            return true;
        }

        return false;
    }

    /**
     * End with.
     *
     * @param string $comparable
     *
     * @return bool
     */
    public static function endWith($value, $comparable) {
        if (\is_array($comparable) || \is_array($value) || \is_object($comparable) || \is_object($value)) {
            return false;
        }

        if (preg_match("/{$comparable}$/", $value)) {
            return true;
        }

        return false;
    }

    /**
     * Match with pattern.
     *
     * @param string $comparable
     *
     * @return bool
     */
    public static function match($value, $comparable) {
        if (\is_array($comparable) || \is_array($value) || \is_object($comparable) || \is_object($value)) {
            return false;
        }

        $comparable = trim($comparable);

        if (preg_match("/^{$comparable}$/", $value)) {
            return true;
        }

        return false;
    }

    /**
     * Contains substring in string.
     *
     * @param string $value
     * @param string $comparable
     *
     * @return bool
     */
    public static function contains($value, $comparable) {
        return strpos($value, $comparable) !== false;
    }

    /**
     * Dates equal.
     *
     * @param string $value
     * @param string $comparable
     *
     * @return bool
     */
    public static function dateEqual($value, $comparable, $format = 'Y-m-d') {
        $date = date($format, strtotime($value));

        return $date === $comparable;
    }

    /**
     * is given value instance of value.
     *
     * @param string $value
     * @param string $comparable
     *
     * @return bool
     */
    public static function instance($value, $comparable) {
        return $value instanceof $comparable;
    }

    /**
     * is given value exits in given key of array.
     *
     * @param string $value
     * @param string $comparable
     *
     * @return bool
     */
    public static function any($value, $comparable) {
        if (\is_array($value)) {
            return \in_array($comparable, $value, true);
        }

        return false;
    }

    /**
     * is given value exits in given key of array.
     *
     * @param string $value
     * @param string $comparable
     *
     * @return bool
     */
    public static function execFunction($value, $comparable) {
        if (\is_array($value)) {
            return \in_array($comparable, $value, true);
        }

        return false;
    }
}
