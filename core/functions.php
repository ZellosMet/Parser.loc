<?
function Dump($data)
{
    echo "<pre>";
        var_dump($data);
    echo "<pre>";
}

function DieDump($data)
{
    Dump($data);
    die;    
}

function Abort($code = "404")
{
    require_once ERRORS."/{$code}.tmpl.php";
    die;
}

?>