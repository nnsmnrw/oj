<?php require_once("admin-header.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
if(isset($_POST['do'])){
	require_once("../include/check_post_key.php");
	$fp=fopen($OJ_SAE?"saestor://web/msg.txt":"msg.txt","w");
	$msg=$_POST['msg'];
	if (get_magic_quotes_gpc ()) {
		$title = stripslashes ( $title);
	}
	$msg=RemoveXSS($msg);
	fputs($fp,$msg);
	fclose($fp);
	echo "Update At ".date('Y-m-d h:i:s');
}


$msg=file_get_contents($OJ_SAE?"saestor://web/msg.txt":"msg.txt");
include("kindeditor.php");

?>
<div class="container">
	<form action='setmsg.php' method='post'>
		<textarea name='msg' rows=25 class="kindeditor" ><?php echo $msg?></textarea><br>
		<input type='hidden' name='do' value='do'>
		<input type='submit' value='change'>
		如果升级无法修改公告，发送“修改公告”到微信公众号onlinejudge看解决方案。<br>
		if this does not work, try run "sudo chown -R www-data /home/judge/src/web " in terminal.
		<?php require_once("../include/set_post_key.php");?>
	</form>
</div>
<?php require_once('../oj-footer.php');
?>
