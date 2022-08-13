<?php

require 'database.php';

$lig = $db->prepare("INSERT INTO ligs (lig_name) VALUES (?)");

$uygula = $lig->execute([

    $_POST['name']

]);


include 'footer.php';

header('Location: index.php');