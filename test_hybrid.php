<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Bootstrap Laravel minimal untuk pakai controller
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Ambil PDF terbaru
$files = glob('storage/app/private/krs/*.pdf');
usort($files, fn($a,$b) => filemtime($b)-filemtime($a));
$pdfPath = realpath($files[0]);
echo "Testing: $pdfPath\n\n";

// Instansiasi controller dan test extractCourseListFromText via reflection
$ctrl = new \App\Http\Controllers\ScheduleController();
$ref  = new ReflectionMethod($ctrl, 'extractCourseListFromText');
$ref->setAccessible(true);
$courses = $ref->invoke($ctrl, $pdfPath);

echo "=== HASIL extractCourseListFromText (" . count($courses) . " matakuliah) ===\n";
echo str_pad("No",4).str_pad("Nama",35).str_pad("Jam",16)."Ruangan\n";
echo str_repeat("-",70)."\n";
foreach ($courses as $c) {
    printf("%-4s %-35s %-16s %s\n",
        $c['no'],
        substr($c['course'],0,34),
        ($c['start_time']??'null').'-'.($c['end_time']??'null'),
        $c['room']??'-'
    );
}

echo "\n=== TEST FULL parseViaGeminiVision ===\n";
$ref2 = new ReflectionMethod($ctrl, 'parseViaGeminiVision');
$ref2->setAccessible(true);
$result = $ref2->invoke($ctrl, $pdfPath);

echo "Hasil (" . count($result) . " matakuliah):\n";
echo str_pad("No",4).str_pad("Nama",35).str_pad("Hari",10).str_pad("Jam",16)."Ruangan\n";
echo str_repeat("-",80)."\n";
foreach ($result as $r) {
    printf("%-4s %-35s %-10s %-16s %s\n",
        $r['no']??'-',
        substr($r['course']??'-',0,34),
        $r['day']??'null',
        ($r['start_time']??'-').'-'.($r['end_time']??'-'),
        $r['room']??'-'
    );
}
