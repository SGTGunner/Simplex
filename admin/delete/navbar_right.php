<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/var.php');
if($user->is_logged_in()){
	if($isadmin == 'true'){
		if (isset($_GET['id']) && is_numeric($_GET['id'])){
			$id = $_GET['id'];
				if ($stmt = $conn->prepare("DELETE FROM navbar_right WHERE id = ? LIMIT 1")){
					$stmt->bind_param("i",$id);	
					$stmt->execute();
					$stmt->close();
				}else{
					echo "ERROR: could not prepare SQL statement.";
			}$conn->close();
					header("Location: ../?admin=navbar");
		}else{
			header("Location: ../?admin=navbar");
		}
	}
}