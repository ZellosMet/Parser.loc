<?
require_once LIB.'/Parsedown.php';

$parser = new Parsedown();

$load_title = "";
$load_content = "";
$parser_load_title = "";
$parser_load_content = "";
$success = null;

if(isset($_POST['btn_del']))
{
    if(isset($_COOKIE["doc_id"]) && $_COOKIE["doc_id"] != 0)
    {
        $id = $_COOKIE["doc_id"];
        $sql = "DELETE FROM Document WHERE Document_id = ?";
        $success = $db->query($sql, [$id]);
    }
}

if(isset($_POST['btn_clear']))
{
    $load_title = "";
    $load_content = "";
    $parser_load_title = "";
    $parser_load_content = "";
    setcookie("doc_id", 0, time() - 60+60);
}

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
        $success = $db->query($sql, [$title, $content, date('Y-m-d'), $id]);        
    }    
    else
    {
        $sql = "INSERT INTO Document (Document_title, Document_content, Document_data_create, Document_last_modified) VALUES (?, ?, ?, ?)";
        $success = $db->query($sql, [$title, $content, date('Y-m-d'), date('Y-m-d')]);
    }

    if($success > 0)
       $success = "success!";
    else 
        Abort();
}

$sql = "SELECT Document_id, Document_title, Document_content, Document_data_create, Document_last_modified FROM Document ORDER BY Document_last_modified  DESC";    
$documents = $db->query($sql)->findAll();

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
        }
    }
}

//Dump($documents);

require_once VIEWS.'/index.tmpl.php';

?>