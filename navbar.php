<?php
//0. SESSION開始！！
session_start();

//1.DB接続*** 外部ファイルを読み込む ***
include("funcs.php");
//loginチェック
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table;");
$status = $stmt->execute();
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

<header class="text-gray-600 body-font bg-yellow-400">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-800 mb-4 md:mb-0">
      <span class="ml-3 text-2xl font-bold">BOOK管理アプリ</span>
    </a>
    <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
      <a class="mr-5 hover:text-blue-500" href="index.php">データ登録</a>
      <a class="mr-5 hover:text-blue-500" href="select.php">登録データ一覧</a>
      <a class="mr-5 hover:text-blue-500" href="logout.php">ログアウト</a>
      <!-- 管理者メニューの親要素に relative クラスを追加 -->
      <div class="relative inline-block text-left">
        <button id="kanri_flg" class="mr-5 hover:text-blue-500">管理者メニュー</button>
        <!-- ドロップダウンメニューの定義 -->
        <div class="hidden absolute z-50 mt-2 py-2 w-32 bg-white rounded-md shadow-lg">
          <!-- ドロップダウンメニュー内のリンク -->
          <a href="user_list.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">User一覧</a>
          <a href="signup.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">User登録</a>
        </div>
      </div>
      <!-- ドロップダウンメニューここまで -->
    </nav>
  </div>
</header>

<!-- jQueryを使ってドロップダウンメニューを制御するスクリプト -->
<script>


  $(document).ready(function() {
    // 管理者メニューの親要素を取得
    const adminMenuParent = $('.relative');

    // ドロップダウンメニューを非表示にする関数
    function hideDropdownMenu() {
      const dropdownMenu = adminMenuParent.find('.absolute');
      dropdownMenu.addClass('hidden');
    }

    // 管理者メニューの親要素にマウスオーバー時の処理を追加
    adminMenuParent.mouseenter(function() {
      const dropdownMenu = $(this).find('.absolute');
      dropdownMenu.removeClass('hidden');
    });

    // ドロップダウンメニュー内のリンクがクリックされた場合
    $('.absolute a').click(function(event) {
      // ドロップダウンを閉じないようにするため、イベントの伝播を止める
      event.stopPropagation();
      // ドロップダウンメニューを非表示にする
      hideDropdownMenu();
    });

    // ドキュメント全体をクリックした場合にドロップダウンメニューを非表示にする
    $(document).click(function() {
      hideDropdownMenu();
    });
  });
</script>


