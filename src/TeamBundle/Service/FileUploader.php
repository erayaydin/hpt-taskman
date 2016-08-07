<?php

namespace TeamBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    public static function run(UploadedFile $file, $path)
    {
        if ($file instanceof UploadedFile && $file->getError() == '0') {

            $original_name = $file->getClientOriginalName();
            $name_array = explode('.', $original_name);
            $fileType = $name_array[sizeof($name_array) - 1];
            $valid_file_types = ['jpg', 'png'];

            if (in_array(strtolower($fileType), $valid_file_types)) {

                move_uploaded_file($file, $path . '/' . $original_name);

            }
        }
    }
}