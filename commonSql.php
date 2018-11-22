<?php
function connectDB(){
$user ='root';
$password ='mariadb';
$dbName ='test_db1';
$host ='localhost:3306';
$dsn ="mysql:host={$host};dbname={$dbName};charset=utf8";

    try{
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
        $pdo = NULL;
    } catch (Exception $e) {
        echo '<span class="error">エラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

//SQL実行
function exeSQL($stm){
    try{
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの実行でエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 名前、スキル（講師マイページ）
function nameAndSkill($ID, $pdo){
    $sql = "SELECT ins.nm, sk.lang FROM instructor ins
    INNER JOIN (SELECT skill_user.u_id, skill.lang FROM skill_user s_u
    INNER JOIN skill skl ON s_u.s_id = skill.id) sk
    ON ins.id = sk.u_id WHERE ins.loginId = :id;";
    try{
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id',$ID,PDO::PARAM_INT);
        $result = exeSQL($stm);
        return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 平均評価（講師マイページ）
function getAverage($ID, $pdo){
    $sql = "SELECT avg(evalution.results) FROM instructor ins
    INNER JOIN evalution eva ON ins.id = eva.u_id
    WHERE eva.u_id = :id
    GROUP BY ins.id;";
    try{
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id',$ID,PDO::PARAM_INT);
        $result = exeSQL($stm);
        return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 言語選択プルダウンリスト
function getPullDownList($pdo){
    $sql = "SELECT id,lang FROM skill;";
    try{
        $stm = $pdo->prepare($sql);
        $result = exeSQL($stm);
        return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 講師マイページ　依頼表示
function displayOffer_Ins($ID, $pdo){
    $sql = "SELECT of.order_date, of.limit_date, ins.name, of.contents, 
    app.value, comp.value, com.name, skill.lang 
    FROM offer of
    INNER JOIN instructor ins ON of.u_id = ins.id
    INNER JOIN approval app ON of.app_id = app.id
    INNER JOIN complete comp ON of.complete_id = comp.id
    INNER JOIN company com ON of.c_id = com.id
    INNER JOIN skill sk ON of.s_id = sk.id
    WHERE u_id = :id;"; 
    try{
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id',$ID,PDO::PARAM_INT);
        $result = exeSQL($stm);
        return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 企業マイページ　依頼表示
function displayOffer_Com($ID, $pdo){
    $sql = "SELECT of.order_date, of.limit_date, ins.name, of.contents, 
    app.value, comp.value, com.name, skill.lang 
    FROM offer of
    INNER JOIN instructor ins ON of.u_id = ins.id
    INNER JOIN approval app ON of.app_id = app.id
    INNER JOIN complete comp ON of.complete_id = comp.id
    INNER JOIN company com ON of.c_id = com.id
    INNER JOIN skill sk ON of.s_id = sk.id
    WHERE c_id = :id;";
    try{
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id',$ID,PDO::PARAM_INT);
        $result = exeSQL($stm);
    return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 空き日程表示
function displayVoid($ID, $pdo){
    $sql = "SELECT sche.str_date, sche.end_date FROM instructor ins
    INNER JOIN schedule sche ON ins.id = sche.u_id 
    WHERE sche.u_id = :id;";
    try{
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id',$ID,PDO::PARAM_INT);
        $result = exeSQL($stm);
    return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

?>
