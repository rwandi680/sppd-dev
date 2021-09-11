<?php

/**
 * Terbilang Helper
 *
 * @package	CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author	Gede Lumbung
 * @link	http://gedelumbung.com
 */

if (!function_exists('terbilang')) {
    function terbilang($number)
    {
        $before_comma = trim(to_word($number));
        return ucwords($results = $before_comma);
    }

    function to_word($number)
    {
        $words = "";
        $arr_number = array(
            "",
            "satu",
            "dua",
            "tiga",
            "empat",
            "lima",
            "enam",
            "tujuh",
            "delapan",
            "sembilan",
            "sepuluh",
            "sebelas"
        );

        if ($number < 12) {
            $words = " " . $arr_number[$number];
        } else if ($number < 20) {
            $words = to_word($number - 10) . " belas";
        } else if ($number < 100) {
            $words = to_word($number / 10) . " puluh " . to_word($number % 10);
        } else if ($number < 200) {
            $words = "seratus " . to_word($number - 100);
        } else if ($number < 1000) {
            $words = to_word($number / 100) . " ratus " . to_word($number % 100);
        } else if ($number < 2000) {
            $words = "seribu " . to_word($number - 1000);
        } else if ($number < 1000000) {
            $words = to_word($number / 1000) . " ribu " . to_word($number % 1000);
        } else if ($number < 1000000000) {
            $words = to_word($number / 1000000) . " juta " . to_word($number % 1000000);
        } else if ($number < 1000000000000) {
            $words = to_word($number / 1000000000) . " milyar" . to_word(fmod($number, 1000000000));
        } else {
            $words = "undefined";
        }
        return $words;
    }
}

function format_rupiah($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}
