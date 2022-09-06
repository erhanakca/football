<?php
 require 'database.php';

 $lig = $db->query("SELECT * FROM ligs WHERE lig_id=" . $_GET['lig_id'])->fetch(PDO::FETCH_ASSOC);

 $takimIdleri = $db ->query("SELECT team_id FROM teams WHERE lig_id=" . $_GET['lig_id'])->fetchAll(PDO::FETCH_ASSOC);


 $takim1 = $db->query("SELECT * FROM teams WHERE team_id=" . (int)$takimIdleri[0]['team_id'])->fetch(PDO::FETCH_ASSOC);
 $takim2 = $db->query("SELECT * FROM teams WHERE team_id=" . (int)$takimIdleri[1]['team_id'])->fetch(PDO::FETCH_ASSOC);
 $takim3 = $db->query("SELECT * FROM teams WHERE team_id=" . (int)$takimIdleri[2]['team_id'])->fetch(PDO::FETCH_ASSOC);
 $takim4 = $db->query("SELECT * FROM teams WHERE team_id=" . (int)$takimIdleri[3]['team_id'])->fetch(PDO::FETCH_ASSOC);



 $skor1 = $db->query("SELECT * FROM skors WHERE team_id=" . $takim1['team_id'])->fetch(PDO::FETCH_ASSOC);
 $skor2 = $db->query("SELECT * FROM skors WHERE team_id=" . $takim2['team_id'])->fetch(PDO::FETCH_ASSOC);
 $skor3 = $db->query("SELECT * FROM skors WHERE team_id=" . $takim2['team_id'])->fetch(PDO::FETCH_ASSOC);
 $skor4 = $db->query("SELECT * FROM skors WHERE team_id=" . $takim2['team_id'])->fetch(PDO::FETCH_ASSOC);













