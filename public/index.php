<?
require_once(dirname(__DIR__)."/config/config.php");

require_once CORE."/functions.php";
require_once CONFIG."/db.php";
require_once CORE."/classes/DB.php";
require_once LIB."/Parsedown.php";

$db_config = require(CONFIG."/db.php");

$db = (Db::GetInstance()->GetConnection($db_config));

require_once CORE."/router.php";

?>
