<?php

include 'header.php';

require 'database.php';

$lig = $db->query("SELECT * FROM ligs")->fetchAll(PDO::FETCH_ASSOC)

?>

<a href="lig_add.php">Lig Add</a>

<?php if(count($lig) == 0):

echo '<button type="button" class="btn btn-link disabled">Team Add</button>';

else: echo '<button type="button" class="btn btn-link">Team Add</button>';

endif;

?>

