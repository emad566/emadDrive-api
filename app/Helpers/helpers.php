<?php

use App\Models\Language;
use Carbon\Carbon;



if (!function_exists('CalcMinutesOfTrip')) {
	function CalcMinutesOfTrip($start_date)
	{
		$from = Carbon::createFromFormat('Y-m-d H:i:s', $start_date);
		$to = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
		return $to->diffInMinutes($from);
	}
}

if (!function_exists('tripTimeInMinutes')) {
    function tripTimeInMinutes($from, $to)
    {
        if (!$from || !$to) return '0';

        if (!$from) $from = now();
        if (!$to) $to = now();

        $from = Carbon::createFromFormat('Y-m-d H:i:s', $from);
        $to = Carbon::createFromFormat('Y-m-d H:i:s', $to);
        return $to->diffInMinutes($from);
    }
}
if (!function_exists('convertToMinutes')) {
    function convertToMinutes($second)
    {
        if ($second == 0) {
            return 0;
        }
        $second = $second / 60;
        return round($second, 2, PHP_ROUND_HALF_UP);
    }
}

if (!function_exists('CalcProfit')) {
	function CalcProfit($cost)
	{
		//$data['company_profit'] = roundAmount(($cost * (float) AppSetting::CompanyProfit()) / 100);
		$data['company_profit'] = ($cost * 25) / 100 ;
		$data['captain_profit'] = $cost - $data['company_profit'];
		return $data;
	}
}

/**
 * calc between two days ex: Sunday - Thursday = 4 Days
 */
if (!function_exists('daysUntil')) {
	function daysUntil($start, $end)
	{
		$lookup = ['Sunday' => 0, 'Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3, 'Thursday' => 4, 'Friday' => 5, 'Saturday' => 6];
		$days = $lookup[$end] - $lookup[$start] + ($lookup[$end] <= $lookup[$start] ? 7 : 0);
		return $days;
	}
}

/**
 * Base Url For Image From AtmoDrive Dashboard Project
 */
if (!function_exists('FileBaseURl')) {
	function FileBaseURl($file)
	{
		if ($file) {
			return str_replace(' ', '%20',  env('APP_FILE_URL') . $file);
		}
		return defaultImage();
	}
}
/**
 * Base Url For Image From AtmoDrive Dashboard Project
 */
if (!function_exists('DashboardURl')) {
	function DashboardURl($file)
	{
		if ($file) {
			return str_replace(' ', '%20',  env('DASHBOARD_URL') . $file);
		}
		return defaultImage();
	}
}
/**
 * Get list of languages
 */

if (!function_exists('languages')) {
	function languages()
	{
		$languages = Language::all();
		return $languages;
	}
}


/**
 * Check Date
 */

if (!function_exists('DateLang')) {
	function DateLang($date)
	{
		if (app()->getLocale() == "ar") {
			$months_ar = ["يناير",  "فبراير",  "مارس",  "أبريل",  "مايو",  "يونيو", "يوليو",  "أغسطس", "سبتمبر",  "أكتوبر", "نوفمبر", "ديسمبر"];
			$months_en = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
			$date = str_replace($months_en, $months_ar, $date);
			$day_ar = ["السبت", "الأحد", "الإثنين", "الثلاثاء",  "الأربعاء", "الخميس",  "الجمعة"];
			$day_en = ["Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri"];
			$date = str_replace($day_en, $day_ar, $date);
			$time_ar = ['صباحاً',  'مساءً'];
			$time_en = ['AM', 'PM'];
			$date = str_replace($time_en, $time_ar, $date);
			$numbers_ar = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
			$numbers_en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
			$date = str_replace($numbers_en, $numbers_ar, $date);
		}
		return $date;
	}
}


/**
 * upload64
 */
if (!function_exists('upload64')) {
	function upload64($file, $path)
	{
		$baseDir = 'uploads/' . $path;

		$name = sha1(time() . $file->getClientOriginalName());
		$extension = $file->getClientOriginalExtension();
		$fileName = "{$name}.{$extension}";

		$file->move(public_path() . '/' . $baseDir, $fileName);

		return "{$baseDir}/{$fileName}";
	}
}
/**
 * Upload
 */
if (!function_exists('upload')) {
	function upload($file, $path)
	{
		$baseDir = 'uploads/' . $path;

		$name = sha1(time() . $file->getClientOriginalName());
		$extension = $file->getClientOriginalExtension();
		$fileName = "{$name}.{$extension}";

		$file->move(public_path() . '/' . $baseDir, $fileName);

		return "{$baseDir}/{$fileName}";
	}
}



/**
 * Generate random Color
 */

function random_color_part()
{
	return str_pad(dechex(mt_rand(0, 127)), 2, '0', STR_PAD_LEFT);
}
if (!function_exists('generateRandomColor')) {
	function generateRandomColor()
	{
		return  random_color_part() . random_color_part() . random_color_part();
	}
}
/**
 * Generate Code
 */
if (!function_exists('generateRandomCode')) {
	function generateRandomCode($string)
	{
		return $string . '-' . substr(md5(microtime()), rand(0, 26), 5);
	}
}

/**
 * default Passenger Avatar
 */
if (!function_exists('defaultPassengerAvatar')) {
	function defaultPassengerAvatar()
	{
		return 'assets/images/logo.png';
	}
}
/**
 * default Image
 */
if (!function_exists('defaultImage')) {
	function defaultImage()
	{
		return  asset('assets/images/logo.png');
	}
}



/**
 * Color To Hexa
 */
if (!function_exists('color_to_hex')) {
	function color_to_hex($color)
	{
		$colors  =  array(
			'#black' => '000000',
			'#white' => 'FFFFFF',
			'#silver' => 'C0C0C0',
			'#grey' => 'A9A9A9',
			'#blue' => '0000FF',
			'#red' => 'FF0000',
			'#brown' => '8B4513',
			'#green' => '32CD32',
			'#yellow' => 'FFC300',
		);

		if (isset($colors[$color])) {
			return ($colors[$color]);
		} else {
			return ('FFFFFF');
		}
	}
}


/**
 * Round Amount
 */
if (!function_exists('roundAmount')) {
	function roundAmount($amount)
	{
		return (double)number_format($amount, 2, '.', '');
		//return round($amount, 2, PHP_ROUND_HALF_UP);
	}
}


/**
 * Get Distance By Lat,Lng
 */
if (!function_exists('getDistanceByLatLng')) {
	function getDistanceByLatLng($latFrom, $lngFrom, $latTo, $lngTo)
	{
		$latFrom = deg2rad(LatLng6Digit($latFrom));
		$lngFrom = deg2rad(LatLng6Digit($lngFrom));
		$latTo = deg2rad(LatLng6Digit($latTo));
		$lngTo = deg2rad(LatLng6Digit($lngTo));

		$latDelta = $latTo - $latFrom;
		$lngDelta = $lngTo - $lngFrom;

		$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lngDelta / 2), 2)));
		return array(
			'success' => true,
			'distanceValue' => $angle * 6371000,
			'distance' => $angle * 6371000,
		);
	}
}
/**
 * Get 6 Digit Lat,Lng
 */
if (!function_exists('LatLng6Digit')) {
	function LatLng6Digit($value)
	{
		$precision =  pow(10, 6);
		return ((float)(int)($precision * $value) / $precision);
	}
}



/**
 * getFLName
 */
if (!function_exists('getFLName')) {
	function getFLName($name)
	{
		$parts = explode(' ', $name); // $meta->post_title
		$name_first = array_shift($parts);
		$name_last = array_pop($parts);
		return $name_first.' '.$name_last;
	}
}