<div class="edit">
    <div class="form">
    <?php if($profile): ?>
        <div class="card">
            <div class="card-body">
                    <?php foreach($profile as $prof): ?>
                        <?php echo form_open('students/edit_student/'.$prof['id']); ?>
                            <div class="form-group text-center">
                                <h4 class="card-title"><span class="oi oi-pencil"></span> Edit Student</h4>
                            </div>

                            <div class="form-group">
                                <label for="IdNos">Student ID #</label>
                                <input type="text" class="form-control" name="IdNos" value="<?php echo $prof['IdNos'];?>"  required>
                            </div>
                            <?php if($this->session->flashdata('id_existed')):?>
                                    <div class="form-group">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <?php echo $this->session->flashdata('id_existed');?>
                                        </div>
                                    </div>
                            <?php endif;?>

                            <div class="form-group">
                                <label for="firstname">First name</label>
                                <input type="text" class="form-control" name="firstname" value="<?php echo $prof['Name'];?>" required>
                            </div>

                            <div class="form-group">
                                <label for="lastname">Last name</label>
                                <input type="text" class="form-control" name="lastname" value="<?php echo $prof['Lastname'];?>" required>
                            </div>

                            <div class="form-group">
                                <label for="course">Course</label>
                                <select name="course" id="course" class="form-control">
                                    <option value="<?php echo $prof['Course'];?>"><?php echo $prof['Course'];?></option>
                                    <?php if($courses):?>
                                        <?php foreach($courses as $course): ?>
                                            <option value="<?php echo $course['Course'];?>"><?php echo $course['Course'];?></option>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="barcode">Barcode</label>
                                <input type="text" class="form-control" name="barcode" value="<?php echo $prof['Barcode'];?>" required>
                            </div>
                            <?php if($this->session->flashdata('barcode_existed')):?>
                                    <div class="form-group">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <?php echo $this->session->flashdata('barcode_existed');?>
                                        </div>
                                    </div>
                            <?php endif;?>
                    
                            <div class="form-group">
                                <input type="submit" class="btn btn-block btn-success" value="Save changes" > 
                            </div>
                        <?php echo form_close(); ?>
                    <?php endforeach;?>
                
            </div>
        </div>
        <?php else: ?>
                    <div class="alert alert-danger text-center"> Student not found! </div>
        <?php endif;?>

    </div>
</div>
