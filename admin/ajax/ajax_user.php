<?php
session_start();
include "../../library/config.php";
include "../../library/function_view.php";

if($_GET['action'] == "table_data"){
	$query = mysqli_query($mysqli, "SELECT * FROM user WHERE level!='admin' ORDER BY id_user DESC");
	$data = array();
	$no = 1;
	while($r = mysqli_fetch_array($query)){
	   $row = array();
	   $row[] = $no;
	   $row[] = $r['nama'];
	   $row[] = $r['username'];
	   $row[] = $r['level'];
	   $row[] = create_action($r['id_user']);
	   $data[] = $row;
	   $no++;
	}
		
	$output = array("data" => $data);
	echo json_encode($output);
}

elseif($_GET['action'] == "form_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM user WHERE id_user='$_GET[id]'");
   $data = mysqli_fetch_array($query);	
   echo json_encode($data);
}

elseif($_GET['action'] == "insert"){
   $password = md5($_POST['password']);
   mysqli_query($mysqli, "INSERT INTO user SET
      nama = '$_POST[nama]',
      username = '$_POST[username]',
      password = '$password',
      level= '$_POST[level]'");	
}

elseif($_GET['action'] == "update"){
   $password = md5($_POST['password']);
   mysqli_query($mysqli, "UPDATE user SET
      nama = '$_POST[nama]',
      username = '$_POST[username]',
      password = '$password',
      level = '$_POST[level]'
      WHERE id_user='$_POST[id]'");
}

elseif($_GET['action'] == "delete"){
   mysqli_query($mysqli, "DELETE FROM user WHERE id_user='$_GET[id]'");	
}

?>