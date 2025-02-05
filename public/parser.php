<?
require_once ("../core/lib/Parsedown.php");
$parser = new Parsedown();

$s = $_POST['text'];
$str = $parser->text($s);
echo $str;

?>