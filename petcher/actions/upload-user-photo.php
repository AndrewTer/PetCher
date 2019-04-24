<?php
defined('mypetcher') or header("Location: ../403.php");
        
    $error_img = array();
    $result_upload_user_photo = mysql_query("SELECT * FROM users WHERE id = $id");
    if (mysql_num_rows($result_upload_user_photo) > null)
    {
        $row_upload_user_photo = mysql_fetch_array($result_upload_user_photo);
    }
    
    $user_folder = $row_upload_user_photo["folder"];
    if ($_FILES['file_user_photo']['error'] > 0)
    {
        //в зависимости от номера ошибки выводим соответствующее сообщение
        switch ($_FILES['file_user_photo']['error'])
        {
            case 1: $error_img[] = 'Размер файла превышает допустимое значение UPLOAD_MAX_FILE_SIZE'; break;
            case 2: $error_img[] = 'Размер файла превышает допустимое значение MAX_FILE_SIZE'; break;
            case 3: $error_img[] = 'Не удалось загрузить часть файла'; break;
            case 4: $error_img[] = 'Файл не был загружен'; break;
            case 5: $error_img[] = 'Отсутствует временная папка'; break;
            case 6: $error_img[] = 'Не удалось записать файл на диск'; break;
            case 7: $error_img[] = 'PHP-расширение остановило загрузку файла'; break;
        }
    }else
    {
        //проверяем расширения
        if ($_FILES['file_user_photo']['type'] == 'image/jpeg' || $_FILES['file_user_photo']['type'] == 'image/jpg' || $_FILES['file_user_photo']['type'] == 'image/png' || $_FILES['file_user_photo']['type'] == 'image/JPG'  || $_FILES['file_user_photo']['type'] == 'image/JPEG'  || $_FILES['file_user_photo']['type'] == 'image/PNG'  || $_FILES['file_user_photo']['type'] == 'image/bmp'  || $_FILES['file_user_photo']['type'] == 'image/BMP'  ||  $_FILES['file_user_photo']['type'] == 'image/tiff' || $_FILES['file_user_photo']['type'] == 'image/TIFF'  || $_FILES['file_user_photo']['type'] == 'image/PICT' || $_FILES['file_user_photo']['type'] == 'image/pict' || $_FILES['file_user_photo']['type'] == 'image/gif' || $_FILES['file_user_photo']['type'] == 'image/GIF')
        { 
             $imgext = substr($_FILES['file_user_photo']['name'], strrpos($_FILES['file_user_photo']['name'], '.') + 1);
                //папка для загрузки
             $uploaddir = 'users/'.$user_folder.'/';
             //новое сгенерированное имя файла
             $newfilename = $user_folder.$id.'-'.rand(10,1000).'.'.$imgext;
             //путь к файлу (папка.файл)
            $uploadfile = $uploaddir.$newfilename;
            
            //загружаем файл move_uploaded_file
            if (@move_uploaded_file($_FILES['file_user_photo']['tmp_name'], $uploadfile))
            {
                chmod($uploadfile, 0777);
                $update = mysql_query("UPDATE users SET photo = '$newfilename' WHERE id='$id'");
            }
            else
            {
                $error_img[] = "Ошибка загрузки файла";
            }
        }else
        {
             $error_img[] = "Допустимые расширения: jpeg, jpg, png";
        }
    }
?>