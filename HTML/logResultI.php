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
        connectDB();
        $sql = "SELECT loginId FROM instructor;";
        $list['loginId'] = exeSQL($sql);
        $idflg = false;
        $psflg = false;
        foreach($list['loginId'] as $id){
            if($_POST['inst_id'] === $id){
                $idflag = true;
                $sql = "SELECT ps FROM instructor WHERE loginId = {$id};";
                $ps = exeSQL($sql);
                    if($_POST['inst_ps'] === $ps){
                        $psflag = true;
                        $sql = "SELECT id, nm FROM instructor WHERE lognId = {$id};";
                        $userInfo = exeSQL($sql);
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