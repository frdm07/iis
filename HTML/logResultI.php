<?php
    session_start();
    require_once("../iis/commonSql.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>ログイン認証</title>
</head>
<body>
    <div>
        <?php
        $isError = false;
        if(isset($_POST['inst_id'])){
            $inst_id = trim($_POST['inst_id']);
            if($inst_id===""){
                $isError = true;
            }
        } else {
            $isError = true;
        }
        $pdo = connectDB();
        try{
            $sql = "SELECT loginId FROM instructor;";
            $stm = $pdo->prepare($sql);
            $list['loginId'] = exeSQL($stm);
        } catch (Exception $e) {
            echo '<span class="error">SQLの実行でエラーがありました</span><br>';
            echo $e->getMessage();
            exit();
        }
        $idflg = false;
        $psflg = false;
        foreach($list['loginId'] as $id){
            if($_POST['inst_id'] === $id){
                $idflag = true;
                $pdo = connectDB();
                try{
                    $sql = "SELECT ps FROM instructor WHERE loginId = :id;";
                    $stm = $pdo->prepare($sql);
                    $stm->bindValue(':id',$id,PDO::PARAM_INT);
                    $ps = exeSQL($stm);
                } catch (Exception $e) {
                    echo '<span class="error">SQLの実行でエラーがありました</span><br>';
                    echo $e->getMessage();
                    exit();
                }
                if($_POST['inst_ps'] === $ps){
                    $psflag = true;
                    $pdo = connectDB();
                    try{
                        $sql = "SELECT id, nm FROM instructor WHERE lognId = :id;";
                        $stm = $pdo->prepare($sql);
                        $stm->bindValue(':id',$id,PDO::PARAM_INT);
                        $userInfo = exeSQL($stm);
                    } catch (Exception $e) {
                        echo '<span class="error">SQLの実行でエラーがありました</span><br>';
                        echo $e->getMessage();
                        exit();
                    }
                    $_SESSION['id'] = "{$userInfo['id']}";
                    $_SESSION['user'] = "{$userInfo['nm']}";
                    $_SESSION['loginType'] = "ins";
                    break;
                }
            }
        }
        if($idflag = false){
            $isError = true;
        }
        if($psflag = false){
            $isError = true;
        }
        ?>
        <?php if($isError('true')): ?>
        <span class= "error">ログインIDとパスワードを正しく入力してください。</span>
        <form method="POST" action="loginInst.html">
            <input type="submit" value="ログインページに戻る">
        </form>
        <?php else: ?>
        <span>
            ログインが完了しました。
            <form method="POST" action="myInst.html">
                <input type="submit" value="マイページへ">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>