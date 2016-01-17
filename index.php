<?php require_once('requires/header.php'); ?>
<?php
	if(!isset($_SESSION['admin'])) {
		Header("Location: ".$dir_site.'login/');
	}
		
	
	if(isset($_GET['action'])) {
		if($_GET['action']=="logout") {
			unset($_SESSION['admin']);
			header("Location: ".$dir_site.'login/');
		}
	}
	
?>
<div id="content">
	<h2> Simple Restful-API Application using PHP in backend </h2>
	


</div>

<?php require_once('requires/footer.php'); ?>