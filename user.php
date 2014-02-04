<?php
	$link = new mysqli("two", "root", "", "one");

	switch ( $_SERVER['REQUEST_METHOD']) {
		case "GET":
			$res = $link->query("SELECT * FROM customer");

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
				$link->query("UPDATE customer SET name='$name' WHERE id=" . $params['id']);
			} else {
				$link->query("INSERT INTO customer (name) VALUES ('$name')");
			}
			//echo "Insert/update good";
			echo json_encode($params);
			break;
		case "DELETE":
			$delId = $_GET['id'];

			$res = $link->query("SELECT name FROM customer WHERE id=" . $delId);
			$line = $res->fetch_array(MYSQLI_ASSOC);

			$delName = $line['name'];

			$link->query("DELETE FROM customer WHERE id=" . $delId);
			echo $delName;
			break;
		default:
			echo "default";
	}
?>
