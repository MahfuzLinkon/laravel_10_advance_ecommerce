<?php

// print data with pre;
use Intervention\Image\Facades\Image;

if(!function_exists('pre')){
    function pre($data)
    {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
} // End Function

// Format Date Function
if (!function_exists('get_formatted_date')){
    function get_formatted_date ($date, $format)
    {
        return date($format, strtotime($date));
    }
} // End Function

// Upload Image Using Image Intervention
function uploadImage($imageObject, $directory, $existingUrl = null, $width =null, $height =null) : string
{
    if ($imageObject){
        if ($existingUrl){
            if (file_exists($existingUrl)){
                unlink($existingUrl);
            }
        }
        $imageName = time().'-'.rand(111, 999).'.'.$imageObject->getClientOriginalExtension();
        if (!file_exists($directory)){
            mkdir($directory, 0777, true);
        }
        $imagePath = $directory . $imageName;
        if ($width && $height){
            Image::make($imageObject)->resize($width, $height)->save($imagePath);
        }else{
            Image::make($imageObject)->save($imagePath);
        }
    }else {
        if ($existingUrl){
            $imagePath = $existingUrl;
        }else{
            $imagePath = null;
        }
    }
    return $imagePath;
} // End Function
