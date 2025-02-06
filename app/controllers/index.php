<?
//Объект для парсинга MarkDown-файла
require_once LIB.'/Parsedown.php';
$parser = new Parsedown();

//Рабочие переменные
$load_title = "";
$load_content = "";
$parser_load_title = "";
$parser_load_content = "";
$success = "";
$create_date = " - ";
$modifine_date = " - ";

//Запрос на загрузку файла
if(isset($_POST['btn_upload']))
{
    $uploaddir = ROOT.'/core/file/upload/'; //Путь для временного хранения файла
    //Проверяем, что пользователь указал файл
    if($_FILES['textfile']['error'] == UPLOAD_ERR_OK)
    {
        //Получаем расширение загруженого файла
        $array = explode(".", $_FILES["textfile"]["name"]); 
        $extension_file = $array[count($array)-1];
        //Получаем полный путь загружаемого файла на сервер
        $file_path = $uploaddir.$_FILES["textfile"]["name"];
        //Проверяем, что пользователь указал файл с верным расширением
        if($extension_file == "md" || $extension_file == "txt")
        {      
            //Загружаем файл во временной хранилище     
            if(is_uploaded_file(($_FILES["textfile"]["tmp_name"])))
            {
                //Перемещаем файл в каталог на сервере
                if(move_uploaded_file($_FILES["textfile"]["tmp_name"], $file_path))
                {
                    //Получаем текс из файла и выводим его в форму
                    $text = htmlentities(file_get_contents($file_path));
                    $load_content = $text;
                    //Выводим пропарсенный текст в форму
                    $parser_load_content = $parser->text($text);
                    //Удаляем временный файл с сервера
                    unlink($file_path);
                    $success = "File uploaded successfully!";
                } 
                else            
                    $success = "File failed to load!";           
            }
            else        
                $success = "File failed to load!"; 
        }
        else
            $success = "Invalid file format. Supported files .md and .txt";       
    }
    else    
        $success = "File failed to load!";       
}

//Запрос на скачивание файла
if(isset($_POST['btn_download']))
{
    //Получаем путь временного файла на сервере
    $file_path = ROOT.'/core/file/download/html.txt';
    //Получаем текст из формы
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    //Парсим текст из формы и записываем его во временный файл
    $pars_title = $parser->text($title);
    $pars_content = $parser->text($content);
    file_put_contents($file_path, $pars_title."\n\n", FILE_APPEND);
    file_put_contents($file_path, $pars_content, FILE_APPEND);
    //Настраиваем отправку файла и отправляем его пользователю
    header('Content-Description: File Transfer');
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename=' . basename($file_path));
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    //Удаляем временный файл
    unlink($file_path);
    exit;
}

//Запрос на удаление документа из базы
if(isset($_POST['btn_del']))
{
    if(isset($_COOKIE["doc_id"]) && $_COOKIE["doc_id"] != 0)
    {
        $id = $_COOKIE["doc_id"];
        $sql = "DELETE FROM Document WHERE Document_id = ?";
        if($db->query($sql, [$id]))
            $success = "Delete success!";
        else 
            Abort(); 
    }
}

//Запрос на очистку формы
if(isset($_POST['btn_clear']))
{
    $load_title = "";
    $load_content = "";
    $parser_load_title = "";
    $parser_load_content = "";
    setcookie("doc_id", 0, time() - 60+60);
}

//Запрос на сохранение/обновление документа в базе
if(isset($_POST['btn_save']))
{  
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $data_create = date('Y-m-d');

    if($title == "")
        $title = "New document";

    if(isset($_COOKIE["doc_id"]) && $_COOKIE["doc_id"] != 0)   
    {
        $id = $_COOKIE["doc_id"];
        $sql = "UPDATE Document SET Document_title=?, Document_content=?, Document_last_modified=?  WHERE Document_id=?";
        if($db->query($sql, [$title, $content, date('Y-m-d'), $id]))
            $success = "Save success!";
        else 
            Abort(); 
    }    
    else
    {
        $sql = "INSERT INTO Document (Document_title, Document_content, Document_data_create, Document_last_modified) VALUES (?, ?, ?, ?)";
        if($db->query($sql, [$title, $content, $data_create, date('Y-m-d')]))
            $success = "Save success!";
        else 
            Abort();  
    }
}

//Запрос на полечение списка документов с сервера
$sql = "SELECT Document_id, Document_title, Document_content, Document_data_create, Document_last_modified FROM Document ORDER BY Document_last_modified  DESC";    
$documents = $db->query($sql)->findAll();

//Запрос на получение текста документа из базы
if($_SERVER["REQUEST_METHOD"]=="POST")
{ 
    $id = array_key_first($_POST);
    setcookie("doc_id", (int)$id, time() + 60+60);
    foreach ($documents as $document) 
    {
        if($document['Document_id'] == $id)
        {
            $load_title = $document['Document_title'];
            if(str_contains($load_content, "#"))
                $parser_load_title = $parser->text($load_title);
            else
                $parser_load_title = $parser->text("##".$load_title);
            $load_content = $document['Document_content'];
            $parser_load_content = $parser->text($load_content);
            $create_date = $document['Document_data_create'];
            $modifine_date = $document['Document_last_modified'];
        }
    }
}
//Пердстовление
require_once VIEWS.'/index.tmpl.php';

?>