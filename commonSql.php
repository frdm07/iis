<?php
$user ='root';
$password ='mariadb';
$dbName ='test_db1';
$host ='localhost:3306';
$dsn ="mysql:host={$host};dbname={$dbName};charset=utf8";
function connectDB(){
    try{
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo = NULL;
    } catch (Exception $e) {
        echo '<span class="error">エラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

//SQL実行
function exeSQL($insql){
    $sql = $insql;
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// 名前、スキル（講師マイページ）
function nameAndSkill($ID){
    $sql = "SELECT ins.name, sk.lang FROM instructor ins
    INNER JOIN (SELECT skill_user.u_id, skill.lang FROM skill_user s_u
    INNER JOIN skill skl ON s_u.s_id = skill.id) sk
    ON ins.id = sk.u_id WHERE ins.loginId = {$ID};";
    $result = exeSQL($sql);
    return $result;
}

// 平均評価（講師マイページ）
function getAverage($ID){
    $sql = "SELECT avg(evalution.results) FROM instructor ins
    INNER JOIN evalution eva ON ins.id = eva.u_id
    GROUP BY ins.id;";
    $result = exeSQL($sql);
    return $result;
}

// 言語選択プルダウンリスト
function getPullDownList($ID){
    $sql = "SELECT id,lang FROM skill;";
    $result = exeSQL($sql);
    return $result;
}

// 両マイページ　依頼表示
function displayOffer($ID){
    $sql = "SELECT of.order_date, of.limit_date, ins.name, of.contents, 
    app.value, comp.value, com.name, skill.lang 
    FROM offer of
    INNER JOIN instructor ins ON of.u_id = ins.id
    INNER JOIN approval app ON of.app_id = app.id
    INNER JOIN complete comp ON of.complete_id = comp.id
    INNER JOIN company com ON of.c_id = com.id
    INNER JOIN skill sk ON of.s_id = sk.id;";
    $result = exeSQL($sql);
    return $result;
}

// 空き日程表示
function displayVoid($ID){
    $sql = "SELECT sche.str_date, sche.end_date FROM instructor ins 
    INNER JOIN schedule sche ON ins.id = sche.u_id;";
    $result = exeSQL($sql);
    return $result;
}

?>
