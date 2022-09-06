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
$skor3 = $db->query("SELECT * FROM skors WHERE team_id=" . $takim3['team_id'])->fetch(PDO::FETCH_ASSOC);
$skor4 = $db->query("SELECT * FROM skors WHERE team_id=" . $takim4['team_id'])->fetch(PDO::FETCH_ASSOC);

 $team1_gol = 0;
 $team2_gol = 0;
 $team3_gol = 0;
 $team4_gol = 0;

 if ($takim1['strength'] > $takim2['strength']){
     $team1_gol = rand(1, 4);
     $team2_gol = rand(0, 3);
 }else if($takim2['strength'] > $takim1['strength']) {
     $team2_gol = rand(1, 4);
     $team1_gol = rand(0, 3);
 }else {
     $team1_gol = rand(0, 2);
     $team2_gol = rand(0, 2);
 }

if ($takim3['strength'] > $takim4['strength']){
    $team3_gol = rand(1, 4);
    $team4_gol = rand(0, 3);
}else if($takim4['strength'] > $takim3['strength']) {
    $team4_gol = rand(1, 4);
    $team3_gol = rand(0, 3);
}else {
    $team4_gol = rand(0, 2);
    $team3_gol = rand(0, 2);
}

$skor1_hazirla = $db->prepare("UPDATE skors 
                                        SET attigi=:attigi, yedigi=:yedigi, avg=:avg, kazandigi=:kazandigi, puan=:puan 
                                        WHERE team_id=:team_id");
$skor2_hazirla = $db->prepare("UPDATE skors 
                                        SET attigi=:attigi, yedigi=:yedigi, avg=:avg, kazandigi=:kazandigi, puan=:puan 
                                        WHERE team_id=:team_id");
$skor3_hazirla = $db->prepare("UPDATE skors 
                                        SET attigi=:attigi, yedigi=:yedigi, avg=:avg, kazandigi=:kazandigi, puan=:puan 
                                        WHERE team_id=:team_id");
$skor4_hazirla = $db->prepare("UPDATE skors 
                                        SET attigi=:attigi, yedigi=:yedigi, avg=:avg, kazandigi=:kazandigi, puan=:puan 
                                        WHERE team_id=:team_id");

if($team1_gol > $team2_gol){
    $skor1_hazirla->execute([
        'team_id' => $takim1['team_id'],
        'attigi' => (int)$skor1['attigi'] + $team1_gol,
        'yedigi' => (int)$skor1['yedigi'] + $team2_gol,
        'puan' => (int)$skor1['puan'] + 3,
        'avg' => (int)$skor1['avg'] + ($team1_gol - $team2_gol),
        'kazandigi' => (int)$skor1['kazandigi'] + 1
    ]);

    $skor2_hazirla->execute([
        'team_id' => $takim2['team_id'],
        'attigi' => $team2_gol,
        'yedigi' => $team1_gol,
        'puan' => 0,
        'avg' => 0,
        'kazandigi' => 0
    ]);

}else if($team2_gol > $team1_gol){
    $skor1_hazirla->execute([
        'team_id' => $takim1['team_id'],
        'attigi' => $team1_gol,
        'yedigi' => $team2_gol,
        'puan' => 0,
        'avg' => 0,
        'kazandigi' => 0
    ]);

    $skor2_hazirla->execute([
        'team_id' => $takim2['team_id'],
        'attigi' => $team2_gol,
        'yedigi' => $team1_gol,
        'puan' => 3,
        'avg' => $team2_gol - $team1_gol,
        'kazandigi' => 1
    ]);
}else {

    $skor1_hazirla->execute([
        'team_id' => $takim1['team_id'],
        'attigi' => $team1_gol,
        'yedigi' => $team2_gol,
        'puan' => 1,
        'avg' => 1,
        'kazandigi' => 0
    ]);

    $skor2_hazirla->execute([
        'team_id' => $takim2['team_id'],
        'attigi' => $team2_gol,
        'yedigi' => $team1_gol,
        'puan' => 1,
        'avg' => 1,
        'kazandigi' => 0
    ]);
}













