<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ登録</title>
    <link rel="stylesheet" href="style.css">
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
      <input name="book_title" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="">
    </div>
  </div>

  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        本のジャンル
      </label>
    </div>
    <div class="md:w-3/4">
      <input name="book_genre" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="">
    </div>
  </div>

  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        Google BooksのURL
      </label>
    </div>
    <div class="md:w-3/4">
      <input name="book_url" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="">
    </div>
  </div>
  
  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        本を読んだ感想
      </label>
    </div>
    <label class="md:w-3/4">
      <textarea name="book_comment" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-20 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value=""></textArea>
    </label>
  </div>

  <div class="md:flex md:items-center">
    <div class="md:w-1/4"></div>
    <div class="md:w-3/4">
      <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        登録
      </button>
    </div>
  </div>
</form>
</div>

<div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        Google BooksのURL検索
      </label>
    </div>
    <div class="mr-6">
      <input id="key" class="appearance-none border-2 border-gray-200 rounded w-150 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="">
    </div>
    <button id="send" class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        検索
      </button>
</div>



<div class="lg:w-5/6 w-full mx-auto overflow-auto">
<table  class="table-auto w-full text-left whitespace-no-wrap">
  <thead id="list">
    <tr>
    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">表紙</th>
    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">書籍名</th>
    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">著者</th>
    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">URL</th>
    <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
    </tr>
  </thead>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
  $("#list").hide();

  $("#send").on("click", function(){
    $("#list").show();
    const url = "https://www.googleapis.com/books/v1/volumes?q=" + $("#key").val();

    $.ajax({
      url: url,
      dataType: "json"
    }).done(function(data) {
      let html = "";
      for (let i = 0; i < data.items.length; i++) {
        const book = data.items[i];
        const title = book.volumeInfo.title;
        const authors = book.volumeInfo.authors;
        const thumbnail = book.volumeInfo.imageLinks.thumbnail;
        const infoLink = book.volumeInfo.infoLink;

        html += `
          <tr>
            <td><img src="${thumbnail}"></td>
            <td>${title}</td>
            <td>${authors}</td>
            <td>
              <button class="copy-button rounded-md bg-gray-400 text-white text-sm" >URLコピー</button>
              <span class="url">${infoLink}</span>
            </td>
          </tr>
        `;
      }
      $("#list").append(html);

      // 「URLコピー」ボタンをクリックした際にURLをコピーする処理を追加
      $(".copy-button").on("click", function() {
        const url = $(this).siblings(".url").text();
        copyToClipboard(url);
      });
    });
  });

  // テキストをクリップボードにコピーする関数
  function copyToClipboard(text) {
    const tempInput = $("<input>").val(text).appendTo("body").select();
    document.execCommand("copy");
    tempInput.remove();
    alert("URLがコピーされました: " + text);
  }
</script>

</body>
</html>

