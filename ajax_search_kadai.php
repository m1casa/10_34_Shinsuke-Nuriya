<?php
// セキュリティ処理
if(isset($_SERVER["HTTP_REFERER"]) !="http://localhost/php05/select_kadai.php"){
    exit();
}

session_start();

//0. 外部ファイル読み込み
include("functions_kadai.php");

if(!isset($_POST["search"]) && $_POST["search"]==""){
    $s = "";
}else{
    $s = $_POST["search"];
}

//1. DB接続
$pdo = db_con();

//2. データ登録SQL作成
if($s!=""){
    $stmt = $pdo->prepare("SELECT * FROM gs_an_table WHERE name LIKE :s");
    $stmt->bindValue(":s", "%".$s."%", PDO::PARAM_STR);
}else{
    $stmt = $pdo->prepare("SELECT * FROM gs_an_table"); 
}
$status = $stmt->execute();

//3. データ表示
$view="";
if($status==false){
    echo "false";
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
    echo $view;
}
?>