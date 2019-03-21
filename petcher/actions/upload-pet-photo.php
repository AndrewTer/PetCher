<?php
defined('blablapet') or die('Доступ запрещён!');

    if (!empty($_GET["petnum"]))
    {
        $pet_id=clear_string($_GET["petnum"]);
        if (!preg_match('/^\+?\d+$/', $pet_id)) 
        {
            header("Location: index.php");
        }
        
    }else
    {
        header("Location: index.php"); 
        
    }
        
    $error_img = array();
    $result_upload_user_photo = mysql_query("SELECT * FROM users WHERE id = $id");
    if (mysql_num_rows($result_upload_user_photo) > null)
    {
        $row_upload_user_photo = mysql_fetch_array($result_upload_user_photo);
    }
    
    $user_folder = $row_upload_user_photo["folder"];
    if ($_FILES['file_pet_photo']['error'] > 0)
    {
        //в зависимости от номера ошибки выводим соответствующее сообщение
        switch ($_FILES['file_pet_photo']['error'])
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
        if ($_FILES['file_pet_photo']['type'] == 'image/jpeg' || $_FILES['file_pet_photo']['type'] == 'image/jpg' || $_FILES['file_pet_photo']['type'] == 'image/png' || $_FILES['file_pet_photo']['type'] == 'image/JPG'  || $_FILES['file_pet_photo']['type'] == 'image/JPEG'  || $_FILES['file_pet_photo']['type'] == 'image/PNG'  || $_FILES['file_pet_photo']['type'] == 'image/bmp'  || $_FILES['file_pet_photo']['type'] == 'image/BMP'  ||  $_FILES['file_pet_photo']['type'] == 'image/tiff' || $_FILES['file_pet_photo']['type'] == 'image/TIFF'  || $_FILES['file_pet_photo']['type'] == 'image/PICT' || $_FILES['file_pet_photo']['type'] == 'image/pict' || $_FILES['file_pet_photo']['type'] == 'image/gif' || $_FILES['file_pet_photo']['type'] == 'image/GIF')
        { 
             $imgext = substr($_FILES['file_pet_photo']['name'], strrpos($_FILES['file_pet_photo']['name'], '.') + 1);
                //папка для загрузки
             $uploaddir = 'users/'.$user_folder.'/';
             //новое сгенерированное имя файла
             $newfilename = $user_folder.$pet_id.'-'.rand(10,1000).'.'.$imgext;
             //путь к файлу (папка.файл)
            $uploadfile = $uploaddir.$newfilename;
            
            //загружаем файл move_uploaded_file
            if (@move_uploaded_file($_FILES['file_pet_photo']['tmp_name'], $uploadfile))
            {
                chmod($uploadfile, 0777);
                $update = mysql_query("UPDATE pets SET photo = '$newfilename' WHERE (owner_id='$id') AND (id='$pet_id')");
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