<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>フリーアンケート記入</title>
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
<form method="post" action="insert_kadai.php" enctype="multipart/form-data">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
    <label>名前：<input type="text" name="name"></label><br>
    <label>Email：<input type="text" name="email"></label><br>
    <!-- <label><textArea name="naiyou" rows="4" cols="40"></textArea></label><br>-->
    <textArea name="naiyou" id="editor1" rows="10" cols="30">
      ご自由にご記入ください。
    </textArea>
    <script>
      CKEDITOR.replace('editor1');
    </script>
    <input type="file" name="upfile"><br>
    <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>