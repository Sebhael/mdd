<?php

if ( ! function_exists('slugIt') )
{
	function slugIt($string='')
	{
		$cleaned = str_replace("'", '', $string);
		$cleaned = str_replace('%20', ' ', $cleaned);
        $cleaned = str_replace('.', '', $cleaned);
        $cleaned = str_replace('!', '', $cleaned);
        $cleaned = str_replace('?','',$cleaned);
		$cleaned = preg_replace('~[^\\pL0-9]+~u', '-', $cleaned);
		$cleaned = trim($cleaned);
		$cleaned = strtolower($cleaned);
		$cleaned = preg_replace('~[^-a-z0-9]+~', '', $cleaned);
		return $cleaned;
	}
} 

if(!function_exists('reverse_date'))
{
    function reverse_date($date)
    {
        $date = strtotime($date);
        $month = date('M',$date);
        $day = date('d', $date);
        $year = date('Y', $date);
        $date = $month . '-' . $day . '-' . $year;
        return $date;
    }
}