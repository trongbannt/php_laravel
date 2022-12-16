<?php

namespace  App\Utilities;

class Helper
{
    /**Function support */
    public static function generatedImageName($image, $folderDestination, $prefixImageName)
    {
        //client image's name and server's image name
        //must be different, why ??
        $ext =  $image->extension();
        $generatedImageName = $prefixImageName.'-' . date('Ymd') . '-' . time() . '.' . $ext;

        //move to a folder
        $image->move(public_path($folderDestination), $generatedImageName);
        return $generatedImageName;
    }
    /**End Function support */
}
