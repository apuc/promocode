<?php


namespace app\services;


class GenerateCodeService
{
    const TYPE_1_LENGTH = 12;
    const TYPE_2_LENGTH = 8;

    /**
     * @param int $length
     * @return false|string
     */
    public static function generateType1($length=self::TYPE_1_LENGTH) {
        $alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return self::generateString($length, $alphabet);
    }

    /**
     * @param int $length
     * @return false|string
     */
    public static function generateType2($length=self::TYPE_2_LENGTH) {
        $alphabet = '0123456789';
        return self::generateString($length, $alphabet);
    }

    /**
     * @param int $lenght
     * @param string $alphabet
     * @return false|string
     */
    private static function generateString($lenght, $alphabet) {
        return substr(str_shuffle(str_repeat($x=$alphabet, ceil($lenght/strlen($x)) )),1,$lenght);
    }
}