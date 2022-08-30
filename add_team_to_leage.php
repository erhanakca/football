<?php include 'header.php'; ?>
<?php require 'database.php'; ?>
<?php $lig = $db->query("SELECT * FROM ligs")->fetchAll(PDO::FETCH_ASSOC); ?>
<?php $team = $db->query("SELECT * FROM teams")->fetchAll(PDO::FETCH_ASSOC) ?>

<div class="container mt-5">
    <div class="row py-4">
        <ul class="list-group col-sm-6 col-12 col-lg-6">
            <span class="list-group-item fs-5 bg-success text-light"><i class="fa-solid fa-shield-halved"></i> Leagues</span>
            <?php foreach ($lig as $item): ?>
            <?php if ($item['team_count']!= 4): ?>
            <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">
                <a href="team_add.php?lig_id=<?php echo $item['lig_id']?>"><?php echo $item['lig_name'] ?></a>
                <span class="badge bg-warning rounded-pill"><?php echo $item['team_count'] ?> TEAM</span>
            </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    <div/>
<div/>

<?php include 'footer.php'?>
