<?php require_once('requires/parameters.php'); ?>
<html>
<head>
<title> Analytics </title>
<link rel="stylesheet" type="text/css" href="<?php echo $dir_assets_css.'default.css'?>">
</head>
<body>
	<div id="page">
		<div id="sidebar">
			<ul>
			<li><a href="<?php echo $dir_site; ?>">Home</a></li>
			<li>
				Products
				<ul>
				<li><a href="<?php echo $dir_site.'products/'?>"> All Products </a></li>
				<li><a href="<?php echo $dir_site.'products/add/'?>"> Add Product </a></li>
				</ul>
			</li>

			<li>
				Customers
				<ul>
				<li><a href="<?php echo $dir_site.'customers/'?>"> All Customers </a></li>
				<li><a href="<?php echo $dir_site.'customers/add/'?>"> Add Customer </a></li>
				</ul>
			</li>
		</div>