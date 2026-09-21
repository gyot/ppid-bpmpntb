<?php
require 'vendor/autoload.php';
use Smalot\PdfParser\Parser;
$parser = new Parser();
$document = $parser->parseFile('Petunjuk_Teknis_Tauval_KIP_Tahun_2026.pdf');
$text = $document->getText();
echo mb_substr($text, 32000, 8000);
