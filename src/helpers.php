<?php

if (!function_exists('convert_sum_for_db')) {
    /**
     * Convert float value 10.00 or 10.0 to DB integer format
     * @param string $sum
     * @return int
     */
    function convert_sum_for_db(string $sum): int
    {
        return (int)($sum * 100);
    }
}

if (!function_exists('convert_sum_for_view')) {
    /**
     * Convert integer value 100 to view float format 1.00
     * @param int $sum
     * @return string
     */
    function convert_sum_for_view(int $sum): string
    {
        $result = $sum / 100;

        if(stripos($result, ".") === false){
            return $result.".00";
        }

        $tmp = explode(".", $result);

        if(strlen($tmp[1]) == 1){
            return $result."0";
        }

        return $result;
    }
}
