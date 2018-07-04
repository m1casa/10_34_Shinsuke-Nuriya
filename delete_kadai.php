<?php
include("functions_kadai.php");

//1. POSTでParamを取得
$id = $_GET["id"];

//2. DB接続
$pdo = db_con();

//3. UPDATE gs_an_table SET ....; で更新(bindValue)
$stmt = $pdo->prepare("DELETE FROM gs_an_table WHERE id=:id");
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  header("Location: select_kadai.php");
  exit;
}

?>