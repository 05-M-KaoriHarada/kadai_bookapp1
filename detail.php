<?php
//0. SESSION開始！！
session_start();

$id = $_GET['id'];

// 外部ファイルを読み込む ***
include("funcs.php");
sschk();//LOGINチェック 
$pdo = db_conn();//1.DB接続

//２．SQLから特定のidを取り出して表示する
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id;");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  sql_error($stmt);
  
}else{
  //SQL成功の場合
  $row = $stmt->fetch();//1レコードだけ取得する方法 stmt->fetch
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>登録内容</title>

</head>
<body>
<!-- Navigation Barの読み込み -->
<?php include("navbar.php"); ?>

<!-- 登録FORM -->
<div class="m-6" >
<form class="w-full max-w-xl" method="post" action="insert.php">
  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        本のタイトル
      </label>
    </div>
    <div class="md:w-3/4">
      <input name="book_title" value="<?=$row["book_title"]?>" class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text">
    </div>
  </div>

  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        本のジャンル
      </label>
    </div>
    <div class="md:w-3/4">
      <input name="book_genre" value="<?=$row["book_genre"]?>" class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text">
    </div>
  </div>

  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        Google BooksのURL
      </label>
    </div>
    <div class="md:w-3/4">
      <input name="book_url" value="<?=$row["book_url"]?>" class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text">
    </div>
  </div>
  
  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        本を読んだ感想
      </label>
    </div>
    <label class="md:w-3/4">
      <textarea name="book_comment" class="appearance-none border-2 border-gray-200 rounded w-full h-20 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text"><?=$row["book_comment"]?></textArea>
    </label>
  </div>
  
  <input type="hidden" name="id" value="<?=$id?>"><!-- idを隠して、update.phpに送信 -->
  
  <div class="md:flex md:items-center">
    <div class="md:w-1/4"></div>
    <div class="md:w-3/4">
      <button class="shadow bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        更新
      </button>
    </div>
  </div>
</form>
</div>





</body>
</html>
