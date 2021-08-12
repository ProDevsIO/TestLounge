<?php
namespace App\Helpers;

use \Milon\Barcode\DNS2D;


class BarcodeHelper {

    public function generate(string $content)
    {
        $d = new DNS2D();
        return "data:image/png;base64,".$d->getBarcodePNG($content, 'QRCODE');
    }

}
