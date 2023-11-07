<?php

namespace App\Helpers;

class Helper
{
    /**
     * Convert to local date
     * @param String - Date Format 
     * @return String - Date Format
     */
    public static function localDate($date)
    {
        $month = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $d = date('d', strtotime($date));
        $m = date('m', strtotime($date));
        $month = $month[$m - 1];
        $year = date('Y', strtotime($date));
        return $d . " " . $month . " " . $year;
    }

    /**
     * Get day from the given number.
     *
     * The number are numeric representation of the day of the week,
     * for example: 0 for Sunday, 6 for Saturday.
     *
     * @param int|string $num Numeric representation of the day of the week.
     * @return string
     */
    public static function localDay($num)
    {
        $days = [
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        ];

        return $days[$num];
    }
}
