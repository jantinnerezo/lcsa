<div class="flex-page">
        <div class="card">
            <div class="card-body">
                <h3><span class="oi oi-warning"></span> Are you sure you want to remove checker <?php echo $name; ?> ?</h3>
                <hr>
                <div class="row">
                <div class="col-md">
                    <a href="<?php echo base_url();?>checkers/remove?checker_id=<?php echo $id;?>&checker_name=<?php echo $name; ?>" class="btn btn-block btn-danger">Yes</a>
                </div>
                <div class="col-md">
                <a href="<?php echo base_url();?>checkers" class="btn btn-block btn-info">No</a>
                </div>
            </div>
            </div>
           
        </div>

</div>

