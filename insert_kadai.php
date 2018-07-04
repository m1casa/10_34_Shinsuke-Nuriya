<?php
include("functions_kadai.php");
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["email"]) || $_POST["email"]=="" ||
  !isset($_POST["naiyou"]) || $_POST["naiyou"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$naiyou = $_POST["naiyou"];

//Fileアップロードチェック
if(isset($_FILES["upfile"]) && $_FILES["upfile"]["error"]==0){
  $file_name = $_FILES["upfile"]["name"];
  $tmp_path  = $_FILES["upfile"]["tmp_name"];
  $file_dir_path = "upload/";

  $extension = pathinfo($file_name, PATHINFO_EXTENSION);
  $uniq_name = date("YmdHis").md5(session_id()) . "." . $extension;
  $file_name = $file_dir_path.$uniq_name;
 
  $img="";
  if(is_uploaded_file($tmp_path)){
      if(move_uploaded_file($tmp_path, $file_name)){
          chmod($file_name,0644);
      }else{
          echo "Error:アップロードできませんでした。";
      }
  }
}else{
  $img = "画像が送信されていません";
}

//2. DB接続
$pdo = db_con();

//3. データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_an_table(id, name, email, naiyou,
indate, image )VALUES(NULL, :a1, :a2, :a3, sysdate(), :image)");
$stmt->bindValue(':a1', $name,   PDO::PARAM_STR);
$stmt->bindValue(':a2', $email,  PDO::PARAM_STR);
$stmt->bindValue(':a3', $naiyou, PDO::PARAM_STR);
$stmt->bindValue(':image', $uniq_name, PDO::PARAM_STR);
$status = $stmt->execute();

//4. データ登録処理後
if($status==false){
  queryError($stmt);

}else{
  //5. indexへリダイレクト
  header("Location: index_kadai.php");
  exit;
}
?>