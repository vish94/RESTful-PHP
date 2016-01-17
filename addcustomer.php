<?php require_once('requires/header.php'); ?>

<div id="content">
	<h2> Add Customer</h2>
	<form method="POST" action="<?php echo $dir_site.'customers/'; ?>">
		<label for="textname"> Customer Name </label><br/>
		<input type="text" name="name" id="textname"><br/><br/>

		<input type="submit" value="Submit" name="submit">
	</form>

</div>

<?php require_once('requires/footer.php'); ?>