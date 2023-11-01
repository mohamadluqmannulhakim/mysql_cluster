<?php
	try{
        // CHANGE THE DB INFO ACCORDING TO YOUR DATABASE
        $db_host = '127.0.0.1';
        $db_name = 'db';
        $db_username = 'clusteradmin';
        $port = "6446";
        $db_password = 'clusteradmin123';
        $conn = new PDO('mysql:host='.$db_host.';port='.$port.';dbname='.$db_name,$db_username,$db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($conn) {
			echo 'connected<br>';
			$stmt = $conn->prepare("SELECT id, username FROM users LIMIT 1");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$result = $stmt->fetchAll();
			print_r($result);
        }
        else {
			echo 'failed';
        }
        // return $conn;
	}
	catch(PDOException $e){
		echo "Connection error ".$e->getMessage();
		exit;
	}
?>