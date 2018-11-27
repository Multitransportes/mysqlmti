<?php
session_start();
require_once('database/Database.php');
$db = new Database();
$_SESSION['login']=="";
date_default_timezone_set('America/Mexico_City');
$ldate=date( 'd-m-Y h:i:s A', time () );
$sql = "UPDATE userlog  SET logout = ? WHERE uid =? ORDER BY id DESC LIMIT 1";
$result = $db->updateRow($sql, [$ldate,$_SESSION['id']]);

//$user->update_Row($ldate,$_SESSION['id']);
session_unset();
//session_destroy();
$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
//document.location="./user-login.php";
document.location="../index.html";
</script>
