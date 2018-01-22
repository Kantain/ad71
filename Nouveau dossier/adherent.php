<?php
session_start();

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
		<?php
		echo $html->index();
		echo '<div class="compte">';
		echo $html->form_infos();
		echo '</div>';
		?>
	</main>
</body>
</html>