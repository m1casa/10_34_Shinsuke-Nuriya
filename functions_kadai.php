<?php

//DB接続
function db_con(){
  $dbname='gs_db_dev10';
  try {
    $pdo = new PDO('mysql:dbname='.$dbname.';charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
  return $pdo;
}

//SQL処理エラー
function queryError($stmt){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

function h($str){
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

?>