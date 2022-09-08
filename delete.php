<?php

require 'database.php';

$lig = $db->exec("DELETE FROM ligs WHERE lig_id");

$team = $db->exec("DELETE FROM teams WHERE team_id");

$skor = $db->exec("DELETE FROM skors WHERE skor_id");

header('Location: index.php' );

die();
