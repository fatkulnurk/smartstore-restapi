<?php
/**
 * Created by PhpStorm.
 * User: rudi
 * Date: 8/15/2018
 * Time: 8:22 AM
 */

require 'function.php';

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';

// cek apakah parameter tersedia
if(isset($_REQUEST['url'])){
    $url = $_REQUEST['url'];
}else{
    $url = "http://dibumi.com";
}

// mendapatkan data html dengan meng curl $url
$html = http_request("$url");

// membuat object untuk generate PDF dan pengaturan
$mpdf = new \Mpdf\Mpdf([
    // https://mpdf.github.io/reference/mpdf-variables/overview.html
    // https://mpdf.github.io/paging/page-size-orientation.html
    'mode' => 'utf-8',
    'format' => 'Legal',
    // 'format' => [190, 236],
    'orientation' => 'P'
]);

// menulis html ke pdf
$mpdf->WriteHTML($html);

// melihat hasil generate pdf
//$mpdf->Output();

// menyimpan hasil ke file
// https://mpdf.github.io/reference/mpdf-functions/output.html
$mpdf->Output('struk.pdf', \Mpdf\Output\Destination::FILE);


/* MENGHUBUNGKAN KE PRINTER */
/* Call this file 'hello-world.php' */
//use Mike42\Escpos\PrintConnectors\FilePrintConnector;
//use Mike42\Escpos\Printer;
//$connector = new FilePrintConnector("php://stdout");
//$printer = new Printer($connector);
//$printer -> text("Hello World!\n");
//$printer -> cut();
//$printer -> close();


use Mike42\Escpos\Printer;
use Mike42\Escpos\ImagickEscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
/*
 * This is three examples in one:
 *  1: Print an entire PDF, normal quality.
 *  2: Print at a lower quality for speed increase (CPU & transfer)
 *  3: Cache rendered documents for a speed increase (removes CPU image processing completely on subsequent prints)
 */

/* 1: Print an entire PDF, start-to-finish (shorter form of the example) */
$pdf = 'struk.pdf';
$connector = new FilePrintConnector("php://stdout");
$printer = new Printer($connector);
try {
    $pages = ImagickEscposImage::loadPdf($pdf);
    foreach ($pages as $page) {
        $printer -> graphics($page);
    }
    $printer -> cut();
} catch (Exception $e) {
    /*
	 * loadPdf() throws exceptions if files or not found, or you don't have the
	 * imagick extension to read PDF's
	 */
    echo $e -> getMessage() . "\n";
} finally {
    $printer -> close();
}


/*
 * 2: Speed up printing by roughly halving the resolution, and printing double-size.
 * This gives a 75% speed increase at the expense of some quality.
 *
 * Reduce the page width further if necessary: if it extends past the printing area, your prints will be very slow.
 */
//$connector = new FilePrintConnector("php://stdout");
//$printer = new Printer($connector);
//$pdf = 'resources/document.pdf';
//$pages = ImagickEscposImage::loadPdf($pdf, 260);
//foreach ($pages as $page) {
//    $printer -> graphics($page, Printer::IMG_DOUBLE_HEIGHT | Printer::IMG_DOUBLE_WIDTH);
//}
//$printer -> cut();
//$printer -> close();

/*
 * 3: PDF printing still too slow? If you regularly print the same files, serialize & compress your
 * EscposImage objects (after printing[1]), instead of throwing them away.
 *
 * (You can also do this to print logos on computers which don't have an
 * image processing library, by preparing a serialized version of your logo on your PC)
 *
 * [1]After printing, the pixels are loaded and formatted for the print command you used, so even a raspberry pi can print complex PDF's quickly.
 */
//$connector = new FilePrintConnector("php://stdout");
//$printer = new Printer($connector);
//$pdf = 'resources/document.pdf';
//$ser = 'resources/document.z';
//if (!file_exists($ser)) {
//    $pages = ImagickEscposImage::loadPdf($pdf);
//} else {
//    $pages = unserialize(gzuncompress(file_get_contents($ser)));
//}
//
//foreach ($pages as $page) {
//    $printer -> graphics($page);
//}
//$printer -> cut();
//$printer -> close();
//
//if (!file_exists($ser)) {
//    file_put_contents($ser, gzcompress(serialize($pages)));
//}