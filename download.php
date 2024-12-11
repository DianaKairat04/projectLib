<?php
if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']); // Файл атын декодтау

    // Сервердегі файл жолын тексеру
    $filepath = __DIR__ . '/' . $file;

    if (file_exists($filepath)) {
        // Файлды жүктеу тақырыптарын орнату
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf'); 
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        
        // Файлды шығару
        readfile($filepath);
        exit;
    } else {
        echo "Файл табылмады.";
    }
} else {
    echo "Файл көрсетілмеді.";
}
?>
