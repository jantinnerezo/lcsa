<div class="flex-page">
        <?php if($this->session->flashdata('error')):?>
            <div class="form-group">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $this->session->flashdata('error');?>
                </div>
            </div>
         <?php endif;?>
        <div class="card">
            <div class="card-body">
                <h3>Are you sure you want to remove attendance ?</h3>
                <div class="alert alert-warning">
                    <span class="oi oi-warning"></span> All data recorded in this attendance will be removed also.
                </div>
                <hr>
                <div class="row">
                <div class="col-md">
                    <a href="" data-toggle="modal" data-target="#confirmModal" class="btn btn-block btn-danger">Yes</a>
                </div>
                <div class="col-md">
                    <a href="<?php echo base_url();?>attendance/?program=all&date=<?php echo Date('Y-d-m');?>" class="btn btn-block btn-info">No</a>
                </div>
            </div>
            </div>
           
        </div>

</div>


<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Password required</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          
        </div>
        <?php echo form_open('attendance/removed_true'); ?>
        <div class="modal-body">
            <div class="form-group">
                <div class="alert alert-warning">
                    <span class="oi oi-warning"></span> When removing attendance, password is required for security purposes.
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="attendance_id" value="<?php echo $id;?>" required/>
            </div>
            <div class="form-group">
                <label> Password </label>
                <input type="password" class="form-control" name="password" placeholder="Enter your password" required/>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Ok</button>
        </div>
          <?php echo form_close(); ?>
      </div>
    </div>
  </div>

