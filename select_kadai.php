<?php
//0. 外部ファイル読み込み
include("functions_kadai.php");

//1. DB接続
$pdo = db_con();

//2. データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table");
$status = $stmt->execute();

//3. データ表示
$view="";
if($status==false){
  queryError($stmt);
}else{
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>';
    $view .= '<img src="upload/'.$result["image"].'" width="75">';
    $view .= '<a href="detail_kadai.php?id='.$result["id"].'">';
    $view .= h($result["name"])."[".h($result["indate"])."]";
    $view .= '</a>';
    $view .= '<a href="delete_kadai.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .= '</p>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index_kadai.php">フリーアンケート記入</a>
      <input type="text" id="search">
      <button id="sbtn">検索</button> 
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron" id="list"><?=$view?></div>
  </div>
</div>
<!-- Main[End] -->

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script>
$("#sbtn").on("click", function(){
  $.ajax({
    type: "POST",
    url: "ajax_search_kadai.php",
    datatype: "html",
    data:{
      search:$("#search").val()
    },
    success: function(data) {
      $("#list").html(data);
    }
  });
});
</script>
</body>
</html>