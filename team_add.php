<?php include 'header.php';?>

<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto text-justify mt-2"">
        <div class="mb-3">
            <form method="POST" action="team_data.php">
                <div class="mb-4 pt-3">
                    <input type="text" name="team_name" class="form-control" placeholder="Team Name">
                    <input type="text" name="team_strength" class="form-control" placeholder="Team Strength">
                    <input type="hidden" name="lig_id" value="<?php echo $_GET['lig_id']?>">
                </div>
                <button type="submit" class="btn btn-primary col-md-5 mx-auto text-justify mt-2 ">Add</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'?>
