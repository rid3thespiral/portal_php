<?php
include('core.php');
if(isset($_POST['register'])) {
	$username = isset($_POST['username']) ? clear($_POST['username']) : false;
	$password = isset($_POST['password']) ? clear($_POST['password']) : false;
	$email = isset($_POST['email']) ? clear($_POST['email']) : false;
	if(empty($username) || empty($password) || empty($email)) {
		echo 'Riempi tutti i campi.<br /><br /><a href="javascript:history.back();">Indietro</a>';
	} elseif(strlen($username) > 16) {
		echo 'Username troppo lungo. Massimo 16 caratteri.<br /><br /><a href="javascript:history.back();">Indietro</a>';
	} elseif(strlen($password) < 6 || strlen($password) > 20) {
		echo 'Lunghezza della password non valida. Minimo 6 caratteri e massimo 20.<br /><br /><a href="javascript:history.back();">Indietro</a>';
	} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Indirizzo email non valido.';
	} elseif(strlen($email) > 60) {
		echo 'Lunghezza dell\'indirizzo email non valida. Massimo 60 caratteri.<br /><br /><a href="javascript:history.back();">Indietro</a>';
	} elseif(mysql_num_rows(mysql_query("SELECT * FROM users WHERE username LIKE '$username'")) > 0) {
		echo 'Username già in uso. Sei pregato di sceglierne un altro.<br /><br /><a href="javascript:history.back();">Indietro</a>';
	} elseif(mysql_num_rows(mysql_query("SELECT * FROM users WHERE email LIKE '$email'")) > 0) {
		echo 'Indirizzo email già in uso. Sei pregato di sceglierne un altro.<br /><br /><a href="javascript:history.back();">Indietro</a>';
	} else {
		$password = md5($password);
		$ip = $_SERVER['REMOTE_ADDR'];
		if(mysql_query("INSERT INTO users (username, password, email, reg_ip, last_ip, reg_date) VALUES ('$username','$password','$email','$ip','$ip',UNIX_TIMESTAMP())")) {
			echo 'Registrazione andata a buon fine.';
		} else {
			echo 'Errore nella query: '.mysql_error();
		}
	}
} else {
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<label>Username: <input type="text" name="username" required maxlength="16" /></label><br />
		<label>Password: <input type="password" name="password" required maxlength="20" /></label><br />
		<label>Email: <input type="email" name="email" required maxlength="60" /></label><br /><br />
		<input type="submit" name="register" value="Registrati" />
	</form>
	<?php
}
?>