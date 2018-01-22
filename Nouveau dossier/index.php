<?php
session_start();
$_SESSION['root']=dirname(__FILE__);

require_once("classes/Form.php");
require_once("classes/html.php");
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	$html = new HTML(null,"utf-8","Alliance Dojo 71","styleIndex.css");
	echo $html->meta_data();
	?>
</head>
<body>
	<?php
	echo $html->header("Intranet Alliance Dojo 71");
	?>
	<main>
		<form>
			<input type="text" name="login" placeholder="login">
			<input type="password" name="mdp" placeholder="mot de passe">
			<input type="submit" name="connexion">
		</form>
	</main>
</body>
</html>