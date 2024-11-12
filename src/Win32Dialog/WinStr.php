<?php

namespace Win32Dialog;

use FFI;

class WinStr
{
    public static function char16(string $string): ?FFI\CData
    {
        $utf16_str = iconv("UTF-8", "UTF-16LE", $string);
        $length = strlen($utf16_str);
        $buffer = FFI::new("unsigned short[" . ($length / 2 + 1) . "]");

        for ($i = 0; $i < $length; $i += 2) {
            $buffer[$i / 2] = unpack("S", substr($utf16_str, $i, 2))[1];
        }

        return $buffer;
    }

    public static function wchar(string $string): ?FFI\CData
    {
        return self::char16($string);
    }

    public static function char32(string $string): ?FFI\CData
    {
        $utf32_str = iconv("UTF-8", "UTF-32LE", $string);
        $length = strlen($utf32_str);
        $buffer = FFI::new("char32_t[" . ($length / 4 + 1) . "]");

        for ($i = 0; $i < $length; $i += 4) {
            $buffer[$i / 4] = unpack("L", substr($utf32_str, $i, 4))[1];
        }

        return $buffer;
    }
}
