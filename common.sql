-- 名前、スキル（講師マイページ）
SELECT ins.name, sk.lang FROM instructor ins
INNER JOIN (SELECT skill_user.u_id, skill.lang FROM skill_user s_u
INNER JOIN skill skl ON s_u.s_id = skill.id) sk
ON ins.id = sk.u_id;

-- 平均評価（講師マイページ）
SELECT avg(evalution.results) FROM instructor ins
INNER JOIN evalution eva ON ins.id = eva.u_id
GROUP BY ins.id;

-- 言語選択プルダウンリスト
SELECT id,lang FROM skill;

-- 両マイページ　依頼表示
SELECT of.order_date, of.limit_date, ins.name, of.contents, 
app.value, comp.value, com.name, skill.lang 
FROM offer of
INNER JOIN instructor ins ON of.u_id = ins.id
INNER JOIN approval app ON of.app_id = app.id
INNER JOIN complete comp ON of.complete_id = comp.id
INNER JOIN company com ON of.c_id = com.id
INNER JOIN skill sk ON of.s_id = sk.id;

-- 空き日程表示
SELECT sche.str_date, sche.end_date FROM instructor ins 
INNER JOIN schedule sche ON ins.id = sche.u_id;
