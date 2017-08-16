<?php
    header('Content-Type: text/html; charset=utf-8');
    ini_set('display_errors',true);
    error_reporting(E_ALL);


/* Создаем объект upload_images, у которого поле upload_image - это массив, содержащий загруженные картинки  */
    if (isset($_FILES['filename'])) {
        $upload_images = new stdClass();
        $upload_image = array();

        if (isset($_FILES['filename'])) {
            foreach ($_FILES['filename'] as $name => $item) {
                foreach ($item as $key => $value) {
                    $upload_image[$key][$name] = $value;
                }
            }
        }

        $upload_images->upload_image = $upload_image; /* Массив загруженных пользователем изображений. */
        $upload_images->upload_max_filesize = ini_get('upload_max_filesize'); /* Максимальный размер закачиваемого файла. */
        $upload_images->post_max_sizes = ini_get('post_max_size');  /* Устанавливает максимально допустимый размер данных, отправляемых методом POST. */
        $upload_images->max_file_uploads = ceil($upload_images->post_max_sizes / $upload_images->upload_max_filesize); /* Количество файлов допустимых за одну загрузку с макимальным размером */
        $upload_images->upload_dir = "files/"; /* Директория для хранения изображений, если не существует, то создаем */

        if (file_exists($upload_images->upload_dir)) {
        } else {
            mkdir($upload_images->upload_dir);
        }
    }


    function canUploadimages($file, $obj)
    {
        $msg = '';
        foreach ($file as $key => $img) {
            $message =  canUpload($file[$key],$obj);
            $msg .= "<span>"."{$message}"."</span>";
        }

        return $msg;
    }


    function canUpload($value, $object)
    {
        $getMime = explode('.',$value['name']);
        $mime = strtolower(end($getMime));
        $whitelist = array('jpeg', 'jpg', 'png', 'gif');
        $whitelist_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $whitelist_imagetypes = ['1', '2', '3']; /* '1'-'IMAGETYPE_GIF', '2'-'IMAGETYPE_JPEG', '3'-'IMAGETYPE_PNG'; */

                if ($value['error'] !== 0) { /* Проверка кода ошибки загружаемого файла */
                    $messageError = $value['name'].' - '.errorMessage($value['error']);
                    return $messageError;
                } elseif (!in_array($mime, $whitelist)) { /* Проверка расширения загружаемого файла */
                    $messageError = $value['name'].' - Недопустимый тип файла';
                    return $messageError;
                } elseif (!(in_array($value['type'], $whitelist_types))) {
                    $messageError = $value['name'].' - Недопустимый тип файла';
                    return $messageError;
                } elseif (!(in_array(exif_imagetype($value['tmp_name']), $whitelist_imagetypes))) {
                    $messageError = $value['name'].' - Неизвестный тип файла';
                    return $messageError;
                } else {
                    $object->succes[]=$value;
                    $messageError = $value['name'] . ' - Файл успешно загружен';
                    return $messageError;
                }
    }


    function makeUpload($object) {
        $drow_img = '';
        foreach ($object as $key => $img) {
            $name = $img['name'];
            $base = pathinfo($name, PATHINFO_FILENAME);
            $base_rand = substr(md5(uniqid(mt_rand(), true)), 0, 4);
            $file_ext = pathinfo($name, PATHINFO_EXTENSION);
            $name = encodestring($base) . '_' . "{$base_rand}" . '.' . $file_ext;

            if (move_uploaded_file($img['tmp_name'], 'files/' . $name)) {
                $drow_img .= '<img src="' . 'files/' . $name . '" >';
            }
        }

        return  $drow_img;
    }


    /* Проверка кода ошибки в $_FILE['filename']['error']*/
    function errorMessage($code)
    {
        switch ($code) {
            case 1:
                $message = "Файл не был загружен. Пожалуйста, обратитесь в службу поддержки сайта!";
                break;
            case 2:
                $message = "Размер загружаемого файла превысил максимально допустимый размер. Пожалуйста, попробуйте ещё!";
                break;
            case 3:
                $message = "Загружаемый файл был получен только частично. Пожалуйста, попробуйте ещё!";
                break;
            case 4:
                $message = "Файл не был загружен. Пожалуйста, попробуйте ещё!";
                break;
            case 5:
            case 6:
            case 7:
            case 8:
                $message = "Файл не был загружен. Пожалуйста, обратитесь в службу поддержки сайта!";
                break;

            default:
                $message = "При загрузке файла возникла неизвестная ошибка. Пожалуйста, попробуйте ещё!";
                break;
        }

        return $message;
    }


    function encodestring($string)
    {
        $table = array(
            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'YO',
            'Ж' => 'ZH',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'J',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'М' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'H',
            'Ц' => 'C',
            'Ч' => 'CH',
            'Ш' => 'SH',
            'Щ' => 'CSH',
            'Ь' => '',
            'Ы' => 'Y',
            'Ъ' => '',
            'Э' => 'E',
            'Ю' => 'YU',
            'Я' => 'YA',

            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'yo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'j',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'csh',
            'ь' => '',
            'ы' => 'y',
            'ъ' => '',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',
        );

        $output = str_replace(
            array_keys($table),
            array_values($table),$string
        );

        return $output;
    }
?>