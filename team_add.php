<?php include 'header.php';?>
<?php require 'database.php';?>
<?php $team = $db->query("SELECT * FROM teams")->fetchAll(PDO::FETCH_ASSOC); ?>
<?php $lig = $db->query("SELECT * FROM ligs")->fetchAll(PDO::FETCH_ASSOC); ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto text-justify mt-2"">
        <div class="mb-3">
            <form method="POST" action="team_data.php">
                <div class="mb-4 pt-3">
                    <input type="text" name="team_name" class="form-control" placeholder="Team Name">
                    <input type="text" name="team_strength" class="form-control" placeholder="Team Strength (%)">
                    <input type="hidden" name="lig_id" value="<?php echo $_GET['lig_id']?>">
                </div>
                <button type="submit" class="btn btn-primary col-md-5 mx-auto text-justify mt-2 ">Add</button>
            </form>
        </div>
    </div>
</div>


<div class="container mt-5">
    <div class="row justify-content-center">
        <ul class="list-group col-sm-6 col-12 col-lg-6">
            <span class="list-group-item fs-5 bg-dark text-light"><i class="fa-solid fa-people-group"></i> Teams</span>
               <?php  $bul = $db->query("SELECT team_name FROM teams WHERE lig_id=" . $_GET['lig_id'])->fetchAll(PDO::FETCH_ASSOC); ?>
               <?php foreach ($bul as $item): ?>
                <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">
                    <?php echo $item['team_name']?>
               </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php include 'footer.php'; ?>
