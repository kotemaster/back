<?php
	$link = new mysqli("two", "root", "", "one");
	$tabName = 'product';

	switch ( $_SERVER['REQUEST_METHOD']) {
		case "GET":
			$res = $link->query("SELECT * FROM $tabName");

			$a = [];
			while ($line = $res->fetch_array(MYSQLI_ASSOC)) {
				array_push($a, $line);
			}
			echo json_encode( $a );
			break;
		case "POST":
			//$params = file_get_contents("php://input");
			$params = $_POST;
			$name = $params['name'];

			if (isset($params['id'])) {
				$link->query("UPDATE $tabName SET name='$name' WHERE id=" . $params['id']);
			} else {
				$link->query("INSERT INTO $tabName (name) VALUES ('$name')");
			}
			//echo "Insert/update good";
			echo json_encode($params);
			break;
		case "DELETE":
			$delId = $_GET['id'];
			$res = $link->query("select name from $tabName where id=$delId");
			echo "Product with id $delId - deleted";
			break;
		default:
			echo "default";
	}
?>
