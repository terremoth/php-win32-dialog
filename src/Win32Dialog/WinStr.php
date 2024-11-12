<?php

namespace Win32Dialog;

use FFI;

class WinStr
{
    public static function char16(string $string): ?FFI\CData
    {
        $utf16Str = iconv("UTF-8", "UTF-16LE", $string);
        $length = strlen($utf16Str);
        $ffi = FFI::cdef();
        $buffer = $ffi->new("unsigned short[" . ($length / 2 + 1) . "]");

        for ($i = 0; $i < $length; $i += 2) {
            $buffer[$i / 2] = unpack("S", substr($utf16Str, $i, 2))[1];
        }

        return $buffer;
    }

    public static function wchar(string $string): ?FFI\CData
    {
        return self::char16($string);
    }

    public static function char32(string $string): ?FFI\CData
    {
        $utf32Str = iconv("UTF-8", "UTF-32LE", $string);
        $length = strlen($utf32Str);
        $ffi = FFI::cdef();
        $buffer = $ffi->new("unsigned int[" . ($length / 4 + 1) . "]");

        for ($i = 0; $i < $length; $i += 4) {
            $buffer[$i / 4] = unpack("L", substr($utf32Str, $i, 4))[1];
        }

        return $buffer;
    }
}
