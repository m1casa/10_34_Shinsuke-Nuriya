<?php
include("functions_kadai.php");

//1. GETでidを取得
$id = $_GET["id"];

//2. DB接続
$pdo = db_con();

//3. SELECT * FROM gs_an_table WHERE id=***; を取得（bindValueを使用！）
$stmt = $pdo->prepare("SELECT * FROM gs_an_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  $row = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>フリーアンケート詳細表示</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
  <script src="./ckeditor/ckeditor.js"></script>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select_kadai.php">フリーアンケート一覧</a></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update_kadai.php">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
    <label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
    <label>Email：<input type="text" name="email" value="<?=$row["email"]?>"></label><br>
    <!-- <label><textArea name="naiyou" rows="4" cols="40"></textArea></label><br> -->
    <textArea name="naiyou" id="editor1" rows="10" cols="30">
      <?=$row["naiyou"]?>
    </textArea>
    <script>
      CKEDITOR.replace('editor1');
    </script>
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>