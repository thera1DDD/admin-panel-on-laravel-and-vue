<?php
if (!function_exists('getImage')) {

    function getImage($filename)
    {
        if (!empty($filename)) {
            return '/storage/' . $filename;
        }
        return $filename;
    }

}
