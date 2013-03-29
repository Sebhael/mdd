<?php if ( ! defined('BASEPATH')) exit('no direct script access allowed.');

/**
 * Reverse Date Function
 * 
 * Reformats DATETIME from SQL to build the front page's TimeStamp.
 * 
 * @param   string  $date
 * @return  string  #date 
 */
if(!function_exists('slugIt'))
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
    function reverse_datetime($date)
    {
        $date = new DateTime($date);
        $result = $date->format('m-d-Y, h:i:sa');
        return $result;
    }
}

if(!function_exists('datediff'))
{
    function datediff($date)
    {
        $date1 = new DateTime("now");
        $date2 = new DateTime($date);
        $inter = $date1->diff($date2);
        return $inter->format('%a days');

    }
}

if ( ! function_exists('get_ext') )
{
    function get_ext($file)
    {
        $ext = pathinfo($file);
        return $ext['extension'];
    }
}

if(!function_exists('multi_unique'))
{
    function multi_unique($array)
    {
        foreach($array as $k => $na)
        {
            $new[$k] = serialize($na);
        }
        $uniq = array_unique($new);
        foreach($uniq as $k => $ser)
        {
            $new1[$k] = unserialize($ser);
        }
        return($new1);
    }
}
/* End of file common_helper.php */
/* Location: .application/helpers/common_helper.php */