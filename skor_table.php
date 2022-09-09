<?php include 'header.php';?>
<?php require 'database.php';?>

<?php $team = $db->query(" SELECT * FROM teams") ?>
<?php $skor = $db->query(" SELECT * FROM skors ORDER BY puan DESC ")->fetchAll(PDO::FETCH_ASSOC); ?>
<?php $sonuc = array_merge($team, $skor)?>
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
                <?php foreach ($skor as $item): ?>
                <thead>
                <tr>
                    <th><?php echo $item['team_id']?></th>
                    <th><?php echo $item['attigi']?></th>
                    <th><?php echo $item['yedigi']?></th>
                    <th><?php echo $item['mac_sayisi']?></th>
                    <th><?php echo $item['avg']?></th>
                    <th><?php echo $item['puan']?></th>
                </tr>
                </thead>
                <?php endforeach;?>
            </table>
        </ul>
    </div>
</div>


