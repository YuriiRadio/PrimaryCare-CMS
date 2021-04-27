<?php
$check_updates = false;

$url_zip = "https://github.com/YuriiRadio/PrimaryCare-CMS/archive/refs/heads/master.zip";
$url_versions = "https://raw.githubusercontent.com/YuriiRadio/PrimaryCare-CMS/master/versions.txt";
$update_dir = __DIR__ . DIRECTORY_SEPARATOR . "updates"; #site/updates
$version_file_name = basename($url_versions); #versions.txt
$archive_name = basename($url_zip); #master.zip
$branch = basename($url_zip, ".zip"); #master
$updates_folder_name = explode("/", parse_url($url_zip)['path'])[2] . "-" . $branch; #PrimaryCare-CMS-master

echo "<pre>";
echo "PHP_VERSION " . PHP_VERSION . "<br />";
echo "__DIR__ - " . __DIR__ . "<br />";
echo "<br /><br />----------------------<br /><br />";

if ($check_updates) {

    /*
        return [
            'update' => $update,
            'rem_ver' => $remote_version,
            'loc_ver' => $local_version,
            'errors' => $errors
        ];
    */

    $check_updates = checkUpdates($url_versions, $version_file_name);
    if (!empty($check_updates['errors'])) {
        foreach ($check_updates['errors'] as $key => $error) {
            echo '<b>Error: '.$key.'</b><br />';
            echo 'type: '.$error['type'].'<br />';
            echo 'message: '.$error['message'].'<br />';
            echo 'file: '.$error['file'].'<br />';
            echo 'line: '.$error['line'].'<br /><br />';

        }
    }

    if ($check_updates['update']) {
        echo 'Remote version: ' . $check_updates['rem_ver'] . '<br />';
        echo 'Local version: ' . $check_updates['loc_ver'] . '<br />';

        #Dovnload
        $download = downloadArchiv($url_zip, $update_dir, $archive_name);
        if (!empty($check_updates['errors'])) {echo "Errors";}

        #Unzip
        $unzip = unzipArchive($update_dir, $archive_name);

        #Move
        copyDirectory($update_dir . DIRECTORY_SEPARATOR . $updates_folder_name, __DIR__, true);

        #removeDirectory
        if (removeDirectory($update_dir . DIRECTORY_SEPARATOR . $updates_folder_name)) {
            echo 'Remove directory - ' . $update_dir . DIRECTORY_SEPARATOR . $updates_folder_name . " Ok :)";
        }
    }

die;
}

#Copy directory
function copyDirectory($from, $to, $rewrite = true) {
    if (is_dir($from)) {
        @mkdir($to);
        $d = dir($from);
        while (false !== ($entry = $d->read())) {
            if ($entry == "." || $entry == "..") {
                continue;
            }
            copyDirectory("$from/$entry", "$to/$entry", $rewrite);
        }
        $d->close();
    } else {
        if (!file_exists($to) || $rewrite) {
            copy($from, $to);
        }
    }
}

#Remove directory
function removeDirectory($dir) {
    $files = array_diff(scandir($dir), ['.','..']);
    foreach ($files as $file) {
        (is_dir($dir.'/'.$file)) ? removeDirectory($dir.'/'.$file) : unlink($dir.'/'.$file);
    }
    return rmdir($dir);
}

#Clear directory
function clearDirectory($dir = '', $ignore = '') {
    if (!is_dir($dir)) {
        return false;
    }
    $list = scandir($dir);
    foreach ($list as $object) {
        if (($object != '.') && ($object != '..')) {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $object)) {
                clearDirectory($dir . DIRECTORY_SEPARATOR . $object);
                rmdir($dir . DIRECTORY_SEPARATOR . $object);
            } else {
                if ($object != $ignore) {
                    unlink($dir . DIRECTORY_SEPARATOR . $object);
                }
            }
        }
    }
    return true;
}

function checkUpdates($url_versions, $version_file_name){
    $remote_version = "";
    $local_version = "";
    $errors = [];
    $update = false;

    #Завантаження віддаленого номера версії
    $handle = @fopen($url_versions, "r");
    if ($handle) {
//        Echo "Open remote file: $version_file_name - Ok :)<br />";
        while (!feof($handle)) {
        $buffer = trim(fgets($handle, 4096)) . PHP_EOL;
            if (preg_match("/v[0-9]+\.[0-9]+/i", $buffer, $matches)) {
//                preg_match("/v[0-9]+\.[0-9]+\.?[0-9]*/i", $buffer, $matches)
                $remote_version = $matches[0];
                break;
            }
        }
    } else {
        $errors[] = error_get_last();
    }
    @fclose($handle);

    #Відкриття локального номера версії
    $handle = @fopen(__DIR__ . DIRECTORY_SEPARATOR . $version_file_name, "r");
    if ($handle) {
//        Echo "Open local file: $version_file_name - Ok :)<br />";
        while (!feof($handle)) {
        $buffer = trim(fgets($handle, 4096)) . PHP_EOL;
            if (preg_match("/v[0-9]+\.[0-9]+/i", $buffer, $matches)) {
                $local_version = $matches[0];
                break;
            }
        }
    } else {
        $errors[] = error_get_last();
    }
    @fclose($handle);

    #Порівняння версій $str1==$str2=>0; $str1>$str2=>1; $str1<$str2=>-1;
    //$str1 = "v1.1"; $str2 = "v1.1";
    //echo strcasecmp($str1, $str2);

    if (empty($errors)) {
        if (strcasecmp($remote_version, $local_version) > 0) {
            $update = true;
        }
    }

    return [
        'update' => $update,
        'rem_ver' => $remote_version,
        'loc_ver' => $local_version,
        'errors' => $errors
    ];
}

function downloadArchiv($url_zip, $update_dir, $archive_name) {
    $errors = [];
    # 1 варіант
//    if (file_put_contents($update_dir . DIRECTORY_SEPARATOR. $archive_name, file_get_contents($url_zip))) {
//        echo "Zip file downloaded successfully" . "<br />";
//    }
//    else {
//        echo "Zip file downloading failed." . "<br />";
//    }
    # 2 варіант
    if(@copy($url_zip, $update_dir . DIRECTORY_SEPARATOR. $archive_name)) {
        return true;
    } else {
        return ['errors' => error_get_last()];
    }
}

#Unzip
function unzipArchive($update_dir, $archive_name) {
    $zip = new ZipArchive;
    $res = $zip->open($update_dir . DIRECTORY_SEPARATOR. $archive_name);
    if ($res === TRUE) {
//        echo 'Unzip Ok :)' . "<br />";
        $zip->extractTo($update_dir);
        $zip->close();
        return true;
    } else {
//        echo 'Error Unzip :( ' . $res. "<br />";
        return false;
    }
}

/*Функція для відкривання файлу для читання*/
//$handle = fopen(__DIR__ . DIRECTORY_SEPARATOR . "versions.txt", "r");
//ob_start();
//while (!feof($handle)) {
//    $buffer = trim(fgets($handle, 4096)) . PHP_EOL;
//    #Перевірка версії
////    if (strtolower(substr($buffer, 0, 1)) == "v") {
////        echo $buffer;
////    }
//    echo $buffer;
//
//}
//ob_end_flush();
//fclose($handle);

//if ($download) {
//      # 1 варіант
////    if (file_put_contents($saveDir . DIRECTORY_SEPARATOR. $archive_name, file_get_contents($url_zip))) {
////        echo "Zip file downloaded successfully" . "<br />";
////    }
////    else {
////        echo "Zip file downloading failed." . "<br />";
////    }
//    # 2 варіант
//    if(!@copy($url_zip, $update_dir . DIRECTORY_SEPARATOR. $archive_name)) {
//        $errors = error_get_last();
//        echo "COPY ERROR :( ".$errors['type'];
//        echo "<br />\n".$errors['message'];
//    } else {
//        echo "Remote copy OK :)<br />";
//    }
//}