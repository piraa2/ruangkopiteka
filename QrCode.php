<?php

namespace App\Controllers;

use
App\Controllers\BaseControllers;

class QrCode extends BaseControllers
{
    public function generate($tableNumber)
    {
        //Load library QrCode
        require_once APPPATH . 'Libraries/phpqrcode/qrlib.php';

        //direktori penyimpanan QrCode
        $dir = WRITEPATH . 'qrcodes/' ;

        //Cek direktori
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        //buat url berdasarkan nomor meja
        $url = base_url("order/$tableNumber");

        //nama file QrCode
        $fileName = $dir . "qrcode_table_$tableNumber.png";

        //generate QrCode
        \QRcode::png($url,$fileName);

        return $fileName;
    }

    public function index()
    {
        for ($tableNumber = 1; $tableNumber <= 10; $tableNumber++) {
            $this->generate($tableNumber);
        }

        echo "QR Codes have been generated!";
    }
}