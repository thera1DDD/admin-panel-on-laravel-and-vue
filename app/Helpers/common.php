<?php
if (!function_exists('getImage')) {

    function getImage($filename)
    {
        if (!empty($filename)) {
            $trimmedPath = \Illuminate\Support\Str::replaceFirst(\Illuminate\Support\Env::get('APP_URL'),'',$filename);
            return  $trimmedPath;
        }
        return $filename;
    }

}
