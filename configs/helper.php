<?php

if (!function_exists('debug')) {
    function debug($data)
    {
        echo '<pre>';
        print_r($data);
        die;
    }
}

if (!function_exists('upload_file')) {
    function upload_file($folder, $file)
    {
        // Tạo thư mục nếu chưa tồn tại
        $targetDir = PATH_ASSETS_UPLOADS . $folder;
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $folder . '/' . time() . '-' . basename($file["name"]);

        if (move_uploaded_file($file["tmp_name"], PATH_ASSETS_UPLOADS . $targetFile)) {
            return $targetFile;
        }

        throw new Exception('Upload file không thành công!');
    }
}