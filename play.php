<?php include 'header.php';?>
<?php require 'database.php';?>

<div class="container mt-5">
    <div class="row row justify-content-center">
        <ul class="list-group col-sm-6 col-6 col-lg-6">
            <table class="table table-bordered border-info">
                <thead>
                <tr>
                    <th scope="col">SIRA-NO</th>
                    <th scope="col">YENİLGİ</th>
                    <th scope="col">SKOR</th>
                    <th scope="col">PUAN</th>
                    <th scope="col">KAZANILAN</th>
                </tr>
                </thead>

                <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </ul>
    </div>
</div>

<?php

$takim = 60;
$takim1 = 80;

$rnd = rand(10,100);




echo $rnd

?>