<?php

$update_cms = FALSE;

$remote_zip_archive = 'https://github.com/YuriiRadio/PrimaryCare-CMS/archive/refs/heads/master.zip';
$remote_versions_file = 'https://raw.githubusercontent.com/YuriiRadio/PrimaryCare-CMS/master/versions.txt';
$updates_dir = __DIR__ . DIRECTORY_SEPARATOR . 'updates';                                       # /updates
$version_file = basename($remote_versions_file);                                                # versions.txt
$archive_name = basename($remote_zip_archive);                                                  # master.zip
$branch = basename($remote_zip_archive, '.zip');                                                # master
$updates_folder_name = explode('/', parse_url($remote_zip_archive)['path'])[2] . '-' . $branch; # PrimaryCare-CMS-master

$status = [
    'result' => FALSE, # TRUE/FALSE
    'errors' => [], # error_get_last()
    'add_info' => []   # Other additional information ('remote_version' => $remote_version, 'local_version' => $local_version,)
];

echo '<pre>';
echo 'PHP_VERSION ' . PHP_VERSION . '<br>';
echo '__DIR__ - ' . __DIR__ . '<br>';
echo '<br>--------------------------------------------<br><br>';

if ($update_cms) {

    $check_updates = checkUpdates($remote_versions_file, $version_file);

    echo 'Remote version: ' . $check_updates['add_info']['remote_version'] . '<br>';
    echo 'Local version: ' . $check_updates['add_info']['local_version'] . '<br>';

    if ($check_updates['result']) {
        # Download
        if (downloadArchiv($remote_zip_archive, $updates_dir, $archive_name)) {
            echo 'Download: ' . $archive_name . ' Ok :)<br>';
        } else {
            echo 'Error download: ' . $archive_name . ' :(<br>';
            printLastError();
            die;
        }

        # Unzip
        if (unzipArchive($updates_dir, $archive_name)) {
            echo 'Unzip archive: ' . $archive_name . ' Ok :)<br>';
        } else {
            echo 'Error unzip archive: ' . $archive_name . ' :(<br>';
            die;
        };

        # Copy directory
        copyDirectory($updates_dir . DIRECTORY_SEPARATOR . $updates_folder_name, __DIR__, true);

        # Remove directory
        if (removeDirectory($updates_dir . DIRECTORY_SEPARATOR . $updates_folder_name)) {
            echo 'Remove directory - ' . $updates_folder_name . ' Ok :)<br>';
        } else {
            echo 'Error remove directory - ' . $updates_folder_name . ' :(<br>';
            die;
        }

        echo 'Update completed successfully :)<br>';
    } else {
        echo 'No updates found :)<br>';
        printLastError();
    }
} die;

# Print errors
function printLastError() {
    global $status;
    if (!empty($status['errors'])) {
        echo '<b>type:</b> ' . $status['errors']['type'] . '<br>';
        echo '<b>message:</b> ' . $status['errors']['message'] . '<br>';
        echo '<b>file:</b> ' . $status['errors']['file'] . '<br>';
        echo '<b>line:</b> ' . $status['errors']['line'] . '<br><br>';
    }
}

# Dovnload
function downloadArchiv($remote_zip_archive, $updates_dir, $archive_name) {
    global $status;
    if (!is_dir($updates_dir)) {
        if (!@mkdir($updates_dir, 0755)) {
            $status['result'] = FALSE;
            $status['errors'] = error_get_last();
            return $status;
        }
    }
    if (@copy($remote_zip_archive, $updates_dir . DIRECTORY_SEPARATOR . $archive_name)) {
        return $status['result'] = TRUE;
    } else {
        $status['result'] = FALSE;
        $status['errors'] = error_get_last();
        return $status;
    }
}

# Unzip
function unzipArchive($updates_dir, $archive_name) {
    $zip = new ZipArchive;
    $res = $zip->open($updates_dir . DIRECTORY_SEPARATOR . $archive_name);
    if ($res === TRUE) {
//        echo 'Unzip Ok :)' . "<br />";
        $zip->extractTo($updates_dir);
        $zip->close();
        return true;
    } else {
//        echo 'Error Unzip :( ' . $res. "<br />";
        return false;
    }
}

# Copy directory
function copyDirectory($from, $to, $rewrite = true) {
    if (is_dir($from)) {
        @mkdir($to);
        $d = dir($from);
        while (false !== ($entry = $d->read())) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            copyDirectory($from . DIRECTORY_SEPARATOR . $entry, $to . DIRECTORY_SEPARATOR . $entry, $rewrite);
        }
        $d->close();
    } else {
        if (!file_exists($to) || $rewrite) {
            copy($from, $to);
        }
    }
}

# Remove directory
function removeDirectory($dir) {
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        (is_dir($dir . DIRECTORY_SEPARATOR . $file)) ? removeDirectory($dir . DIRECTORY_SEPARATOR . $file) : unlink($dir . DIRECTORY_SEPARATOR . $file);
    }
    return rmdir($dir);
}

function checkUpdates($remote_versions_file, $version_file) {
    $remote_version = '';
    $local_version = '';
    global $status;

    #Завантаження віддаленого номера версії
    $handle = @fopen($remote_versions_file, 'r');
    if ($handle) {
        while (!feof($handle)) {
            $buffer = trim(fgets($handle, 1024)) . PHP_EOL;
            if (preg_match('/v[0-9]+\.[0-9]+/i', $buffer, $matches)) {
                // preg_match("/v[0-9]+\.[0-9]+\.?[0-9]*/i", $buffer, $matches)
                $remote_version = $matches[0];
                break;
            }
        }
    } else {
        $status['result'] = FALSE;
        $status['errors'] = error_get_last();
        return $status;
    }
    @fclose($handle);

    #Відкриття локального номера версії
    $handle = @fopen(__DIR__ . DIRECTORY_SEPARATOR . $version_file, 'r');
    if ($handle) {
        while (!feof($handle)) {
            $buffer = trim(fgets($handle, 1024)) . PHP_EOL;
            if (preg_match('/v[0-9]+\.[0-9]+/i', $buffer, $matches)) {
                $local_version = $matches[0];
                break;
            }
        }
    } else {
        $status['result'] = FALSE;
        $status['errors'] = error_get_last();
        return $status;
    }
    @fclose($handle);

    #Порівняння версій $str1==$str2=>0; $str1>$str2=>1; $str1<$str2=>-1;
    //$str1 = "v1.1"; $str2 = "v1.1";
    if (strcasecmp($remote_version, $local_version) > 0) {
        $status['result'] = TRUE;
    }

    $status['add_info'] = ['remote_version' => $remote_version, 'local_version' => $local_version];

    return $status;
}

# Clear directory
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