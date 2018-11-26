<?php
require_once("commonSql.php");
session_start();
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../CSS/mypage.css">
        <title>マイページ</title>
    </head>
    <body>
        <header>
            <a href="">ログアウト</a>
            <h3>マイページ</h3>
        </header>
        <table border="3">
            <tr>
                <td>
                    <table class="pro" border="2">
                        <tr>
                            <td>氏名：</td>
                            <td>---------</td>
                        </tr>
                        <tr>
                            <td>スキル（言語）：</td>
                            <td>----------</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>評価<br><h3>3.65</h3></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <div>
            <h2>依頼状況</h2>
            <table border="1">
                <tr>
                    <th>依頼元（氏名）</th>
                    <th>要求スキル</th>
                    <th>連絡先</th>
                    <th>メモ</th>
                    <th>承認/非承認</th>
                </tr>
            </table>
        </div>
        <a href="schedule.php">スケジュール入力画面へ</a>
    </body>
</html>