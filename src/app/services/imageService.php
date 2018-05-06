<?php
namespace App\Service;

class ImageService
{
    public function __construct()
    {
    }

    public function convertToBase64($source)
    {
        $path = $source['tmp_name'];
        $type = $this->getType($source['type']);

        $imageCompressed = $this->compress($path, $type);

        $base64 = base64_encode($imageCompressed);

        $data = 'data:image/' . $type . ';base64,' . $base64;

        return $data;
    }

    public function compress($path, $type)
    {
        list($sourceWidht, $sourceHeight) = getimagesize($path);
        $source = imagecreatefromstring(file_get_contents($path));

        $thumbWidht = 320;
        $thumbHeight = 240;


        $ratioSource = $sourceWidht/$sourceHeight;

        if ($thumbWidht / $thumbHeight > $ratioSource) {
            $thumbWidht = $thumbHeight * $ratioSource;
        } else {
            $thumbHeight = $thumbWidht / $ratioSource;
        }


        $thumb = imagecreatetruecolor($thumbWidht, $thumbHeight);

        imagecopyresized(
            $thumb,
            $source,
            0,
            0,
            0,
            0,
            $thumbWidht,
            $thumbHeight,
            $sourceWidht,
            $sourceHeight
        );

        $contents;

        switch ($type) {
            case 'jpeg':
                ob_start();
                imagejpeg($thumb);
                $contents =  ob_get_contents();
                ob_end_clean();
                break;
            case 'gif':
                ob_start();
                imagegif($thumb);
                $contents =  ob_get_contents();
                ob_end_clean();
                break;
            case 'png':
                ob_start();
                imagepng($thumb);
                $contents =  ob_get_contents();
                ob_end_clean();
                break;
        }

        return $contents;
    }


    public function getType($text)
    {
        $pos = strpos($text, '/') + 1;
        return substr($text, $pos, strlen($text));
    }
}
