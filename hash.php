<?php
//PHP5.5より前(PHP5.3.7以降)を使用する場合はpassword_compactライブラリを使う
// require_once 'lib/password.php'; 
//require_once 'lib/h.php';

if (isset($_POST['submit'])) {
  $password = $_POST['password'];

# ハッシュ処理の計算コストを指定します
  $options = array('cost' => 10);
# ハッシュ化方式にPASSWORD_DEFAULTを指定し、パスワードをハッシュ化する。
# password_hash()関数は自動的に安全なソルトを生成してくれる。(ハッシュ値を取得するたびにソルトが自動生成されるので、同じパスワードでもハッシュ値が変わる)
  $hash = password_hash($password, PASSWORD_DEFAULT, $options);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>ハッシュ化済みパスワードを取得するスクリプト</title>
</head>
<body>
<div>
<?php
if (isset($hash)) {
  echo '生パスワード： ' . $password . '<br>';
  echo 'ハッシュ化済みパスワード： ' . $hash;
}
?>
  <hr>
  <form action="" method="post">
    <label for="password">ハッシュ化したいパスワード文字列：</label>
    <input type="text" name="password" id="password" value="">
    <input type="submit" name="submit" value="ハッシュ化">
  </form>
</div>
</body>
</html>