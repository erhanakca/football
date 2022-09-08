<?php include 'header.php';?>
<?php require 'database.php';?>

<?php $team = $db->query(" SELECT * FROM teams") ?>
<?php $skor = $db->query(" SELECT * FROM skors ORDER BY puan")->fetch(PDO::FETCH_ASSOC); ?>

<div class="container mt-5">
    <div class="row row justify-content-center">
        <ul class="list-group col-sm-6 col-6 col-lg-6">
            <table class="table table-bordered border-info">
                <thead>
                <tr>
                    <th scope="col">TAKIM</th>
                    <th scope="col">ATTIĞI GOL</th>
                    <th scope="col">YEDİĞİ GOL</th>
                    <th scope="col">OYNADIĞI MAÇ</th>
                    <th scope="col">AVARAJ</th>
                    <th scope="col">PUAN</th>
                </tr>
                </thead>
                <?php foreach ($team as $team_name and $skor as $skor_table): ?>
                <thead>
                <tr>
                    <th><?php echo $team_name['team_name'] ?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <?php endforeach; ?>



            </table>
        </ul>
    </div>
</div>


