<?php
	if(isset($_POST['submit'])) {
		$xml = '<database><host>'.$_POST['host'].'</host><user>'.$_POST['dbuser'].'</user><pass>'.$_POST['dbpass'].'</pass><name>'.$_POST['dbname'].'</name></database>';
		$file = fopen('../config.xml', "w");
		fwrite($file, $xml);
		fclose($file);

		$host = $_POST['host'];
		$user = $_POST['dbuser'];
		$pass = $_POST['dbpass'];
		$name = $_POST['dbname'];

		$connection=mysqli_connect($host, $user, $pass);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		} else {
			if($_POST['dbselect']==1){
				$sql = "CREATE DATABASE ".$name;
				if(mysqli_query($connection, $sql)) {
					echo "Database Created<br/>";
				}

				else
					echo mysqli_error($connection);
			}
			$sql = "USE ".$name;
			mysqli_query($connection, $sql);

			$sql = "CREATE TABLE customers (id int NOT NULL AUTO_INCREMENT, name VARCHAR(50), PRIMARY KEY(id))";
			if(mysqli_query($connection, $sql)) 
				echo "Table Customers created<br/>";
			else
				echo mysqli_error($connection);

			$sql = "CREATE TABLE products (id int NOT NULL AUTO_INCREMENT, name VARCHAR(50), price int, PRIMARY KEY(id))";
			if(mysqli_query($connection, $sql)) 
				echo "Table Products created<br/>";
			else
				echo mysqli_error($connection);

			$sql = "CREATE TABLE orders (id int NOT NULL AUTO_INCREMENT, customer_id int, product_id int, PRIMARY KEY(id))";
			if(mysqli_query($connection, $sql)) 
				echo "Table Orders created<br/>";
			else
				echo mysqli_error($connection);

			$sql = "CREATE TABLE user (id int NOT NULL AUTO_INCREMENT, username VARCHAR(50), password VARCHAR(50), PRIMARY KEY(id))";
			if(mysqli_query($connection, $sql)) 
				echo "Table Users created<br/>";
			else
				echo mysqli_error($connection);

			$sql = "INSERT into products (name, price) VALUES ('iPhone5s', 40000)";
			mysqli_query($connection, $sql);
			$sql = "INSERT into products (name, price) VALUES ('Motorola', 15000)";
			mysqli_query($connection, $sql);
			$sql = "INSERT into products (name, price) VALUES ('Oneplus 2', 25000)";
			mysqli_query($connection, $sql);
			$sql = "INSERT into products (name, price) VALUES ('Yureka', 10000)";
			mysqli_query($connection, $sql);
			$sql = "INSERT into customers (name) VALUES ('Alex')";
			mysqli_query($connection, $sql);
			$sql = "INSERT into customers (name) VALUES ('Jason')";
			mysqli_query($connection, $sql);
			$sql = "INSERT into orders (customer_id, product_id) VALUES (1,1)";
			mysqli_query($connection, $sql);
			$sql = "INSERT into orders (customer_id, product_id) VALUES (1,3)";
			mysqli_query($connection, $sql);
			$sql = "INSERT into orders (customer_id, product_id) VALUES (2,2)";
			mysqli_query($connection, $sql);
			$sql = "INSERT into user (username, password) VALUES ('admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8')";
			mysqli_query($connection, $sql);
			echo "Test data inserted <br/><br/>";

		}
	}
?>

<html>
<title>Setup</title>
<body>
	<?php if(!isset($_POST['submit'])) { ?>
	<h2> Provide the following information to complete setup of the api </h2>
	<form action="index.php" method="POST">
	<label for="host">SQL Host: </label>
	<input type="text" name="host" id="host"><br/><br/>
	<label for="dbuser">DB User: </label>
	<input type="text" name="dbuser" id="dbuser"><br/><br/>
	<label for="dbpass">DB Password: </label>
	<input type="text" name="dbpass" id="dbpass"><br/><br/>
	<label for="dbselect">Do you want to create a database?</label>
	<select id="dbselect" name="dbselect">
		<option value="1">Yes</option>
		<option value="2">No </option>
	</select><br/><i>Choose No if you have created the database in CPanel. Enter its name below.</i><br/><i>Choose yes to create a new database and enter its name below</i><br/><br/>

	<label for="dbname">Database Name:</label>
	<input type="text" name="dbname" id="dbname"><br/><br/>

	<input type="submit" name="submit" value ="Submit">

	</form>
	<?php } ?>
</body>
</html>