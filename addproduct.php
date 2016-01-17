<?php require_once('requires/header.php'); ?>

<div id="content">
	<h2> Add Product</h2>
	<form method="POST" action="<?php echo $dir_site.'products/'; ?>">
		<label for="textname"> Product Name </label><br/>
		<input type="text" name="name" id="textname"><br/><br/>
		<label for="textprice"> Product Price </label><br/>
		<input type="text" name="price" id="textprice"><br/><br/>

		<input type="submit" value="Submit" name="submit">
	</form>

</div>

<?php require_once('requires/footer.php'); ?>