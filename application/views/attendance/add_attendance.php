<div class="edit">
    <div class="form">
        <div class="card">
            <div class="card-body">
                        <?php echo form_open('add_attendance'); ?>
                            <div class="form-group text-center">
                                <h4 class="card-title"><span class="oi oi-plus"></span> Add attendance</h4>
                            </div>

                            <div class="form-group">
                                <label >Title:</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                           

                            <div class="form-group">
                                <label >Description:</label>
                                <input type="text" class="form-control" name="description" required>
                            </div>

                             <div class="form-group">
                                <input type="hidden" class="form-control" name="program_id" value="<?php echo $this->session->userdata('program_id'); ?>">
                            </div>

                             <div class="form-group">
                                <input type="hidden" class="form-control" name="checker_id" value="<?php echo $this->session->userdata('checker_id'); ?>">
                            </div>


                            <div class="form-group">
                                <label for="password">Attendance type:</label>
                                <select name="attendance_type" class="form-control">
                                    <option value="1">Regular</option>
                                    <option value="2">Sign-in</option>
                                    <option value="3">Sign-out</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-block btn-success" value="Add" > 
                            </div>

                        <?php echo form_close(); ?>
                 
            </div>
        </div>
     

    </div>
</div>
