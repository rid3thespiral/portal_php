<?php
if($_REQUEST['username']!=null && $_REQUEST['password']!=null ){
	$user=$_REQUEST['username'];
	$pass=$_REQUEST['password'];
	$conn=mysql_connect('localhost','root','');
	$db=mysql_select_db('test');
	$q="SELECT * FROM utenti_portale WHERE email='".$user."' and password='".$pass."'";
	$r=mysql_query($q)
		or die(mysql_error());
if(mysql_num_rows($r)==0){
header("Location: wrong.html");
exit();
}
else{
$row=mysql_fetch_array($r);
print_r($row);
if($row[2] == 'admin'){
	session_start();
	$_SESSION['username']=$user;
	header("Location: admin.php");
	exit();	
	}
	else{
		session_start();
		$_SESSION['username']=$user;
		header("Location: subagency.php");
		exit();
	}
	}
}
?>