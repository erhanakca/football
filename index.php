<?php

include 'header.php';

require 'database.php';

$lig = $db->query("SELECT * FROM ligs")->fetchAll(PDO::FETCH_ASSOC);
$team = $db->query("SELECT * FROM teams")->fetchAll(PDO::FETCH_ASSOC)
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-4 mt-5">
            <a href="lig_add.php"><button type="button" class="btn btn-primary col-12 py-3">League Add</button></a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4 mt-5">
            <?php if(count($lig) > 0):
                echo '<a href="add_team_to_leage.php" <button type="button" class="btn btn-success col-12 py-3">Team Add</button></a>';
            else: echo '<a href="add_team_to_leage.php" <button type="button" class="btn btn-success disabled col-12 py-3">Team Add</button></a>';
            endif;
            ?>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row py-4">
            <ul class="list-group col-sm-6 col-12 col-lg-6">
                <span class="list-group-item fs-5 bg-success text-light"><i class="fa-solid fa-shield-halved"></i> Leagues</span>
                <?php foreach ($lig as $item): ?>
                <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">
                    <a href="skor_data.php?lig_id=<?php echo $item['lig_id']?>" ><?php echo $item['lig_name'] ?></a>
                    <span class="badge bg-warning rounded-pill"><?php echo $item['team_count'] ?> TEAM</span>
                </li>
                <?php endforeach; ?>
            </ul>
            <ul class="list-group col-sm-6 col-12 col-lg-6">
                <span class="list-group-item fs-5 bg-dark text-light"><i class="fa-solid fa-people-group"></i> Teams</span>
                <?php foreach ($team as $item): ?>
                <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">
                    <?php echo $item['team_name']?>
                </li>
               <?php endforeach; ?>
            </ul>

        </div>
    </div>
    <script src="https://kit.fontawesome.com/7ed19c3a98.js" crossorigin="anonymous"></script>
    </div>
</div>
