<?php

require 'database.php';

// LEAGE EKLEME
$lig = $db->prepare("INSERT INTO ligs (lig_name) VALUES (?)");

$lig_uygula = $lig->execute([

    $_POST['name']

]);

include 'footer.php';

header('Location: index.php');