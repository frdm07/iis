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
        if(isset($_POST['com_id'])){
            $com_id = trim($_POST['com_id']);
            if($com_id===""){
                $isError = true;
            }
        } else {
            $isError = true;
        }
        require_once("../iis/commonSql.php");
        connectDB();
        $sql = "SELECT loginId, ps FROM company;";
        $list = exeSQL($sql);
        $idflg = false;
        $psflg = false;
        foreach($list['loginId'] as $id){
            if($_POST['com_id'] === $id){
                $idflag = true;
                foreach($list['ps'] as $ps){
                    if($_POST['com_ps'] === $ps){
                        $psflag = true;
                        session_start();
                        $sql = "SELECT id, nm FROM company WHERE lognId = {$id};";
                        $userInfo = exeSQL($sql);
                        $_SESSION['id'] = "{$userInfo['id']}";
                        $_SESSION['name'] = "{$userInfo['nm']}";
                        $_SESSION['loginType'] = "com";
                    }
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
        <form method="POST" action="loginCom.html">
            <input type="submit" value="ログインページに戻る">
        </form>
        <?php else: ?>
        <span>
            ログインが完了しました。
            <form method="POST" action="myCompany.html">
                <input type="submit" value="マイページへ">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>