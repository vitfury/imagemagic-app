<?php

class imagickService
{
    public function resize()
    {
        $image = new \Imagick('~/sample.png');

        $image->resizeImage(256, 350, Imagick::FILTER_CATROM, 0);

        header("Content-Type: image/png");
        echo $image->getImageBlob();
    }
}
