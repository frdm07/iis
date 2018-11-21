<?php
    require_once("../commonSql.php");
    session_start();
?>
<?php
    $list = nameAndSkill($_SESSION['id']);
?>
<!DOCTYPE html>
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
        <?php
        echo "<table border='3'><tr>
                <td><table class='pro' border='2'>
                        <tr>
                            <td>氏名：</td>
                            <td>{$list['name']}</td>
                        </tr>
                        <tr>
                            <td>スキル（言語）：</td>";
        foreach($list['name'] as $skill){
            echo "<td>{$skill}</td>";
        }              
        echo            "</tr>
                    </table></td>
                <td><table>
                        <tr>
                            <td>評価<br><h3>";
        $Vavg = getAverage($_SESSION['id']);                   
        echo "{$Vavg}</h3></td>
                        </tr>
                    </table></td>
            </tr>
        </table>
        <br>
        <div>";
        echo "<h2>依頼状況</h2>
            <table border='1'>
            <thead><tr>
                <th>依頼元（会社名）</th>
                <th>要求スキル</th>
                <th>連絡先</th>
                <th>メモ</th>
                <th>承認/非承認</th>
            </tr></thead>";
        echo "<tbody>";
        foreach (displayOffer_Ins($ID) as $row){
            echo "<tr><td>{}</td>";
            echo "<td>{}</td>";
            echo "<td>{}</td>";
            echo "<td>{}</td>";
            echo "<td>{}</td></tr>";
        }
            </table>
        </div>
        <a href="schedule.html">スケジュール入力画面へ</a>
        ?>
    </body>
</html>