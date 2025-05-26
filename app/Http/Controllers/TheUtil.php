<?php
namespace App\Http\Controllers;
use App\Exceptions\Handler;

class TheUtil
{
    public static function getCurrentTime()
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = \DateTime::createFromFormat('d-m-Y',date('d-m-Y'));
        return $time;
    }

    public static function currentWeek()
    {
        $curr = self::getCurrentTime();
        return (int)$curr->format("W");
    }

    public static function currentDay()
    {
        $curr = self::getCurrentTime();
        return (int)$curr->format("N");
    }

    public static function postfixUploaded()
    {
        $time = self::getCurrentTime()->format('y_m_d_H_i_s');
        return $time;
    }

    public static function waktuSimpleIndonesia()
    {
        $time = self::getCurrentTime()->format('d-m-Y');
        return $time;
    }

    public static function waktuLengkapIndonesia()
    {
        $time = self::getCurrentTime()->format('d-m-Y H:i:s');
        return $time;
    }

    public static function waktuSimpleUS()
    {
        $time = self::getCurrentTime()->format('Y-m-d');
        return $time;
    }

    public static function waktuLengkapUS()
    {
        $time = self::getCurrentTime()->format('Y-m-d H:i:s');
        return $time;
    }

    public static function tanggalNotifNow()
    {
        $time = self::getCurrentTime()->format('dmy');
        return $time;
    }

    public static function tanggalNotif($waktu)
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = \DateTime::createFromFormat('d-m-Y',$waktu);
        $time = $time->format('dmy');
        return $time;
    }

    public static function formatWaktuUS($waktu)
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = \DateTime::createFromFormat('d-m-Y', $waktu);
        $time = $time->format('Y-m-d H:i:s');
        return $time;
    }

    public static function dateFromDMY($waktu)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = \DateTime::createFromFormat('d-m-Y', $waktu);
        return $date;
    }

    public static function dmyToYMD($waktu)
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = \DateTime::createFromFormat('d-m-Y', $waktu);
        $time = $time->format('Y-m-d');
        return $time;
    }

    public static function formatWaktuIndonesia($waktu)
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = \DateTime::createFromFormat('d-m-Y', $waktu);
        $time = $time->format('d-m-Y H:i:s');
        return $time;
    }

    public static function formatWaktuIndonesiaPanjang($waktu)
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = \DateTime::createFromFormat('d-m-Y', $waktu);
        $time = $time->format('d F Y');
        return $time;
    }

    public static function waktuUSfromDB($waktu)
    {
        date_default_timezone_set('Asia/Jakarta');
        if( strlen($waktu) > 10)
            $time = \DateTime::createFromFormat('Y-m-d H:i:s', $waktu);
        else
            $time = \DateTime::createFromFormat('Y-m-d', $waktu);

        $time = $time->format('Y-m-d H:i:s');
        return $time;
    }

    public static function waktuIndonesiaFromDB($waktu)
    {
        date_default_timezone_set('Asia/Jakarta');
        if( strlen($waktu) > 10)
            $time = \DateTime::createFromFormat('Y-m-d H:i:s', $waktu);
        else
            $time = \DateTime::createFromFormat('Y-m-d', $waktu);

        $time = $time->format('d-m-Y H:i:s');
        return $time;
    }
}
