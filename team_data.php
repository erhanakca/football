<?php

require 'database.php';
// TEAM EKLEME

$team = $db->prepare("INSERT INTO teams (lig_id, team_name, team_strength) VALUES (?,?,?)");

$skor = $db->prepare("INSERT INTO skors (team_id) VALUES (?,?)");

$ligHazirla = $db->prepare("UPDATE ligs SET team_count=:team_count WHERE lig_id=:lig_id");

$lig = $db->query("SELECT * FROM ligs WHERE lig_id = " . $_POST['lig_id'])->fetch(PDO::FETCH_ASSOC);
if ($lig['team_count'] < 4){

$teamUygula = $team->execute([

    $_POST['lig_id'],
    $_POST['team_name'],
    $_POST['team_strength'],

]);

$sonTeamId = $db->lastInsertId();
$skorUygula = $skor->execute([
   $sonTeamId
]);
}
if ($teamUygula){
    $ligUygula = $ligHazirla->execute([
       'lig_id' => (int)$_POST['lig_id'],
       'team_count' => $lig['team_count'] + 1
    ]);
}

include 'footer.php';

header('Location: index.php');

