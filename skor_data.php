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

$kontrol = $db->query(" SELECT * FROM skors WHERE skor_id")->fetchAll(PDO::FETCH_ASSOC);



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
                                        SET attigi=:attigi, yedigi=:yedigi, avg=:avg, kazandigi=:kazandigi, puan=:puan, mac_sayisi=:mac_sayisi, yenilgi=:yenilgi
                                        WHERE team_id=:team_id");
$skor2_hazirla = $db->prepare("UPDATE skors
                                        SET attigi=:attigi, yedigi=:yedigi, avg=:avg, kazandigi=:kazandigi, puan=:puan, mac_sayisi=:mac_sayisi, yenilgi=:yenilgi
                                        WHERE team_id=:team_id");
$skor3_hazirla = $db->prepare("UPDATE skors
                                        SET attigi=:attigi, yedigi=:yedigi, avg=:avg, kazandigi=:kazandigi, puan=:puan, mac_sayisi=:mac_sayisi, yenilgi=:yenilgi
                                        WHERE team_id=:team_id");
$skor4_hazirla = $db->prepare("UPDATE skors
                                        SET attigi=:attigi, yedigi=:yedigi, avg=:avg, kazandigi=:kazandigi, puan=:puan, mac_sayisi=:mac_sayisi, yenilgi=:yenilgi
                                        WHERE team_id=:team_id");

if($team1_gol > $team2_gol){

    $skor1_hazirla->execute([
        'team_id' => $takim1['team_id'],
        'attigi' => (int)$skor1['attigi'] + $team1_gol,
        'yedigi' => (int)$skor1['yedigi'] + $team2_gol,
        'puan' => (int)$skor1['puan'] + 3,
        'avg' => (int)$skor1['avg'] + $team1_gol,
        'kazandigi' => (int)$skor1['kazandigi'] + 1,
        'mac_sayisi' => (int)$skor1['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor1['yenilgi'] + 0
    ]);

    $skor2_hazirla->execute([
        'team_id' => $takim2['team_id'],
        'attigi' => (int)$skor2['attigi'] + $team2_gol,
        'yedigi' => (int)$skor2['yedigi'] + $team1_gol,
        'puan' => (int)$skor2['puan'] + 0,
        'avg' => (int)$skor2['avg'] + $team2_gol,
        'kazandigi' => (int)$skor2['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor2['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor2['yenilgi'] + 1
    ]);

}else if($team2_gol > $team1_gol){
    $skor2_hazirla->execute([
        'team_id' => $takim2['team_id'],
        'attigi' => (int)$skor2['attigi'] + $team1_gol,
        'yedigi' => (int)$skor2['yedigi'] + $team2_gol,
        'puan' => (int)$skor2['puan'] + 3,
        'avg' => (int)$skor2['avg'] + $team2_gol,
        'kazandigi' => (int)$skor2['kazandigi'] + 1,
        'mac_sayisi' => (int)$skor2['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor2['yenilgi'] + 0,
    ]);

    $skor1_hazirla->execute([
        'team_id' => $takim1['team_id'],
        'attigi' => (int)$skor1['attigi'] + $team2_gol,
        'yedigi' => (int)$skor1['yedigi'] + $team1_gol,
        'puan' => (int)$skor1['puan'] + 0,
        'avg' => (int)$skor1['avg'] + $team1_gol,
        'kazandigi' => (int)$skor1['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor1['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor1['yenilgi'] + 1,
    ]);
}else {

    $skor1_hazirla->execute([
        'team_id' => $takim1['team_id'],
        'attigi' => (int)$skor1['attigi'] + $team1_gol,
        'yedigi' => (int)$skor1['yedigi'] + $team2_gol,
        'puan' => (int)$skor1['puan'] + 1,
        'avg' => (int)$skor1['avg'] + 1,
        'kazandigi' => (int)$skor1['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor1['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor1['yenilgi'] + 0,
    ]);

    $skor2_hazirla->execute([
        'team_id' => $takim2['team_id'],
        'attigi' => (int)$skor2['attigi'] + $team2_gol,
        'yedigi' => (int)$skor2['yedigi'] + $team1_gol,
        'puan' => (int)$skor2['puan'] + 1,
        'avg' => (int)$skor2['avg'] + 1,
        'kazandigi' => (int)$skor2['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor2['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor2['yenilgi'] + 1,
    ]);
}

if($team3_gol > $team4_gol){
    $skor3_hazirla->execute([
        'team_id' => $takim3['team_id'],
        'attigi' => (int)$skor3['attigi'] + $team3_gol,
        'yedigi' => (int)$skor3['yedigi'] + $team4_gol,
        'puan' => (int)$skor3['puan'] + 3,
        'avg' => (int)$skor3['avg'] + $team3_gol,
        'kazandigi' => (int)$skor3['kazandigi'] + 1,
        'mac_sayisi' => (int)$skor3['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor3['yenilgi'] + 0,
    ]);

    $skor4_hazirla->execute([
        'team_id' => $takim4['team_id'],
        'attigi' => (int)$skor4['attigi'] + $team4_gol,
        'yedigi' => (int)$skor4['yedigi'] + $team3_gol,
        'puan' => (int)$skor4['puan'] + 0,
        'avg' => (int)$skor4['avg'] + $team4_gol,
        'kazandigi' => (int)$skor4['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor4['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor4['yenilgi'] + 1,
    ]);

}else if($team4_gol > $team3_gol){
    $skor4_hazirla->execute([
        'team_id' => $takim4['team_id'],
        'attigi' => (int)$skor4['attigi'] + $team3_gol,
        'yedigi' => (int)$skor4['yedigi'] + $team4_gol,
        'puan' => (int)$skor4['puan'] + 3,
        'avg' => (int)$skor4['avg'] + $team4_gol,
        'kazandigi' => (int)$skor4['kazandigi'] + 1,
        'mac_sayisi' => (int)$skor4['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor4['yenilgi'] + 0,
    ]);

    $skor3_hazirla->execute([
        'team_id' => $takim3['team_id'],
        'attigi' => (int)$skor3['attigi'] + $team4_gol,
        'yedigi' => (int)$skor3['yedigi'] + $team3_gol,
        'puan' => (int)$skor3['puan'] + 0,
        'avg' => (int)$skor3['avg'] + $team3_gol,
        'kazandigi' => (int)$skor3['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor3['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor3['yenilgi'] + 1,
    ]);
}else {

    $skor3_hazirla->execute([
        'team_id' => $takim3['team_id'],
        'attigi' => (int)$skor3['attigi'] + $team3_gol,
        'yedigi' => (int)$skor3['yedigi'] + $team4_gol,
        'puan' => (int)$skor3['puan'] + 1,
        'avg' => (int)$skor3['avg'] + 1,
        'kazandigi' => (int)$skor3['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor3['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor3['yenilgi'] + 0,
    ]);

    $skor4_hazirla->execute([
        'team_id' => $takim4['team_id'],
        'attigi' => (int)$skor4['attigi'] + $team4_gol,
        'yedigi' => (int)$skor4['yedigi'] + $team3_gol,
        'puan' => (int)$skor4['puan'] + 1,
        'avg' => (int)$skor4['avg'] + 1,
        'kazandigi' => (int)$skor4['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor4['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor4['yenilgi'] + 0,
    ]);
}

if ($takim1['strength'] > $takim3['strength'] ){
    $team1_gol = rand(1, 4);
    $team3_gol = rand(0, 3);
}elseif ($takim3['strength'] > $takim1['strength']){
    $team3_gol = rand(1, 4);
    $team1_gol = rand(0, 3);
}else{
    $team1_gol = rand(0, 2);
    $team3_gol = rand(0, 2);
}

if ($takim2['strength'] > $takim4['strength']){
    $team2_gol = rand(1, 4);
    $team4_gol = rand(0, 3);
}elseif ($takim4['strength'] > $takim2['strength']){
    $team4_gol = rand(1, 4);
    $team2_gol = rand(0, 3);
}else{
    $team4_gol = rand(0, 2);
    $team2_gol = rand(0, 2);
}

$skor1 = $db->query("SELECT * FROM skors WHERE team_id=" . $takim1['team_id'])->fetch(PDO::FETCH_ASSOC);
$skor2 = $db->query("SELECT * FROM skors WHERE team_id=" . $takim2['team_id'])->fetch(PDO::FETCH_ASSOC);
$skor3 = $db->query("SELECT * FROM skors WHERE team_id=" . $takim3['team_id'])->fetch(PDO::FETCH_ASSOC);
$skor4 = $db->query("SELECT * FROM skors WHERE team_id=" . $takim4['team_id'])->fetch(PDO::FETCH_ASSOC);


$skor1_hazirla = $db->prepare("UPDATE skors
                                        SET attigi=:attigi, yedigi=:yedigi, avg=:avg, kazandigi=:kazandigi, puan=:puan, mac_sayisi=:mac_sayisi, yenilgi=:yenilgi
                                        WHERE team_id=:team_id");
$skor2_hazirla = $db->prepare("UPDATE skors
                                        SET attigi=:attigi, yedigi=:yedigi, avg=:avg, kazandigi=:kazandigi, puan=:puan, mac_sayisi=:mac_sayisi, yenilgi=:yenilgi
                                        WHERE team_id=:team_id");
$skor3_hazirla = $db->prepare("UPDATE skors
                                        SET attigi=:attigi, yedigi=:yedigi, avg=:avg, kazandigi=:kazandigi, puan=:puan, mac_sayisi=:mac_sayisi, yenilgi=:yenilgi
                                        WHERE team_id=:team_id");
$skor4_hazirla = $db->prepare("UPDATE skors
                                        SET attigi=:attigi, yedigi=:yedigi, avg=:avg, kazandigi=:kazandigi, puan=:puan, mac_sayisi=:mac_sayisi, yenilgi=:yenilgi
                                        WHERE team_id=:team_id");


if($team1_gol > $team3_gol){
    $skor1_hazirla->execute([
        'team_id' => $takim1['team_id'],
        'attigi' => (int)$skor1['attigi'] + $team1_gol,
        'yedigi' => (int)$skor1['yedigi'] + $team3_gol,
        'puan' => (int)$skor1['puan'] + 3,
        'avg' => (int)$skor1['avg'] + $team1_gol,
        'kazandigi' => (int)$skor1['kazandigi'] + 1,
        'mac_sayisi' => (int)$skor1['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor1['yenilgi'] + 0,
    ]);

    $skor3_hazirla->execute([
        'team_id' => $takim3['team_id'],
        'attigi' => (int)$skor3['attigi'] + $team3_gol,
        'yedigi' => (int)$skor3['yedigi'] + $team1_gol,
        'puan' => (int)$skor3['puan'] + 0,
        'avg' => (int)$skor3['avg'] + $team3_gol,
        'kazandigi' => (int)$skor3['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor3['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor3['yenilgi'] + 1,
    ]);

}else if($team3_gol > $team1_gol){
    $skor3_hazirla->execute([
        'team_id' => $takim3['team_id'],
        'attigi' => (int)$skor3['attigi'] + $team3_gol,
        'yedigi' => (int)$skor3['yedigi'] + $team1_gol,
        'puan' => (int)$skor3['puan'] + 3,
        'avg' => (int)$skor3['avg'] + $team3_gol,
        'kazandigi' => (int)$skor3['kazandigi'] + 1,
        'mac_sayisi' => (int)$skor3['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor3['yenilgi'] + 0,
    ]);

    $skor1_hazirla->execute([
        'team_id' => $takim1['team_id'],
        'attigi' => (int)$skor1['attigi'] + $team3_gol,
        'yedigi' => (int)$skor1['yedigi'] + $team1_gol,
        'puan' => (int)$skor1['puan'] + 0,
        'avg' => (int)$skor1['avg'] + $team1_gol,
        'kazandigi' => (int)$skor1['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor1['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor1['yenilgi'] + 1,
    ]);
}else {

    $skor1_hazirla->execute([
        'team_id' => $takim1['team_id'],
        'attigi' => (int)$skor1['attigi'] + $team1_gol,
        'yedigi' => (int)$skor1['yedigi'] + $team3_gol,
        'puan' => (int)$skor1['puan'] + 1,
        'avg' => (int)$skor1['avg'] + 1,
        'kazandigi' => (int)$skor1['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor1['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor1['yenilgi'] + 0,
    ]);

    $skor3_hazirla->execute([
        'team_id' => $takim3['team_id'],
        'attigi' => (int)$skor3['attigi'] + $team3_gol,
        'yedigi' => (int)$skor3['yedigi'] + $team1_gol,
        'puan' => (int)$skor3['puan'] + 1,
        'avg' => (int)$skor3['avg'] + 1,
        'kazandigi' => (int)$skor3['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor3['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor3['yenilgi'] + 0,
    ]);
}

if ($team2_gol > $team4_gol){
    $skor2_hazirla->execute([
        'team_id' => $takim2['team_id'],
        'attigi' => (int)$skor2['attigi'] + $team2_gol,
        'yedigi' => (int)$skor2['yedigi'] + $team4_gol,
        'puan' => (int)$skor2['puan'] + 3,
        'avg' => (int)$skor2['avg'] + $team2_gol,
        'kazandigi' => (int)$skor2['kazandigi'] + 1,
        'mac_sayisi' => (int)$skor2['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor2['yenilgi'] + 0,
    ]);
    $skor4_hazirla->execute([
       'team_id' => (int)$takim4['team_id'],
       'attigi' => (int)$skor4['attigi'] + $team4_gol,
       'yedigi' => (int)$skor4['yedigi'] + $team2_gol,
       'puan' => (int)$skor4['puan'] + 0,
       'avg' => (int)$skor4['avg'] + $team4_gol,
       'kazandigi' => (int)$skor4['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor4['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor4['yenilgi'] + 1,
    ]);
}elseif ($team4_gol > $team2_gol){
    $skor4_hazirla->execute([
       'team_id' => (int)$takim4['team_id'],
       'attigi' => (int)$skor4['attigi'] + $team4_gol,
       'yedigi' => (int)$skor4['yedigi'] + $team2_gol,
       'puan' => (int)$skor4['puan'] + 3,
       'avg' => (int)$skor4['avg'] + $team4_gol,
       'kazandigi' => (int)$skor4['kazandigi'] + 1,
       'mac_sayisi' => (int)$skor4['mac_sayisi'] + 1,
       'yenilgi' => (int)$skor4['yenilgi'] + 0,
    ]);
    $skor2_hazirla->execute([
       'team_id' => (int)$takim2['team_id'],
       'attigi' => (int)$takim2['attigi'] + $team2_gol,
       'yedigi' => (int)$takim2['yedigi'] + $team4_gol,
       'puan' => (int)$takim2['puan'] + 0,
       'avg' => (int)$takim2['avg'] + $team2_gol,
       'kazandigi' => (int)$takim2['kazandigi'] + 0,
       'mac_sayisi' => (int)$skor2['mac_sayisi'] + 1,
       'yenilgi' => (int)$skor2['yenilgi'] + 1,
    ]);
}else{
    $skor4_hazirla->execute([
        'team_id' => (int)$takim4['team_id'],
        'attigi' => (int)$takim4['attigi'] + $team4_gol,
        'yedigi' => (int)$takim4['yedigi'] + $team2_gol,
        'puan' => (int)$takim4['puan'] + 1,
        'avg' => (int)$takim4['avg'] + 1,
        'kazandigi' => (int)$takim4['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor4['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor4['yenilgi'] + 0,
    ]);
    $skor2_hazirla->execute([
        'team_id' => (int)$takim2['team_id'],
        'attigi' => (int)$takim2['attigi'] + $team2_gol,
        'yedigi' => (int)$takim2['yedigi'] + $team4_gol,
        'puan' => (int)$takim2['puan'] + 1,
        'avg' => (int)$takim2['avg'] + 1,
        'kazandigi' => (int)$takim2['kazandigi'] + 0,
        'mac_sayisi' => (int)$skor2['mac_sayisi'] + 1,
        'yenilgi' => (int)$skor2['yenilgi'] + 0,
    ]);
}




header('Location: index.php');

die();






