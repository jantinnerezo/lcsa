<div class="attendance">
    <div class="container-fluid">
         <?php if($this->session->flashdata('success')):?>
            <div class="form-group">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            </div>
         <?php endif;?>
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
        <div class="row text-center">
            <div class="col-md-4">
                
            </div>

            <div class="col-md-4">
                <?php if($attendance): ?>
                             <h4><span class="oi oi-check"></span> <?= $title ?> (<?php echo count($attendance);?>)</h4>
                        <?php else: ?>
                              <h4><span class="oi oi-list"></span> <?= $title ?> (0)</h4>
                    <?php endif; ?>
            </div>

            <div class="col-md-4">
                
            </div>
              
           
        </div>
        <hr>
       
        <div class="row">
            <div class="col-md-6">
                    <div class="input-group">
                            <a href="<?php echo base_url();?>add_attendance" class="btn btn-info"> <span class="oi oi-plus"></span> New </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                            <span class="input-group-addon">
                                Program
                            </span>
                            <select name="sort" id="sort" class="form-control">
                            <?php if($programs): ?>
                                    <option value="all">All</option>
                                    <?php foreach($programs as $program):?>
                                        <option value="<?php echo $program['program'];?>"><?php echo $program['program'];?></option>
                                    <?php endforeach; ?>
                            <?php endif;?>
                            
                            </select>
                    </div>
                </div>
            
                <div class="col-md-3">
                    <div class="input-group">
                            <span class="input-group-addon"><span class="oi oi-calendar"></span> Date</span>
                            <input type="date" id="search_value" class="form-control" placeholder="Search.." >
                            <input type="hidden" id="default_date" class="form-control" placeholder="Search.." value="<?php echo Date('Y-m-d');?>">
                            <input type="hidden" id="base_url" value="<?php echo base_url();?>">
                    </div>
                </div>

        </div>
       
        
        <?php if($attendance): ?>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                        <th> Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Program</th>
                        <th><span class="oi oi-person"></span> Added by</th>
                        <th><span class="oi oi-calendar"></span> Date</th>
                        <th><span class="oi oi-clock"></span>Time</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                        <?php foreach($attendance as $attend):?>
                            <tr>
                                <td><?php echo word_limiter($attend['title'],3);?></td>
                                <td><?php echo word_limiter($attend['description'],5);?></td>
                                <?php if($attend['attendance_type'] == 1): ?>
                                    <td>Regular</td>
                                <?php endif;?>

                                <?php if($attend['attendance_type'] == 2): ?>
                                    <td>Sign-in</td>
                                <?php endif;?>
                                   
                                <?php if($attend['attendance_type'] == 3): ?>
                                     <td>Sign-out</td>
                                <?php endif;?>
                             
                                <?php $created_date = date('M j, Y, D', strtotime($attend['created_time'])); ?>
                                <?php $created_time = date('g:i A', strtotime($attend['created_time'])); ?>

                                <td><?php echo $attend['program'];?></td>
                                <td><?php echo $attend['checker_name'];?></td>
                                <td><?php echo $created_date;?></td>
                                <td><?php echo $created_time;?></td>
                               

                                <?php if($attend['status'] == 1): ?>
                                     <td class="bg-success text-light text-center">Active</td>
                                <?php else:?>
                                      <td class="bg-danger text-light text-center">Inactive</td>
                                <?php endif;?>

                                <td class="text-center">
                                    <a href="<?php echo base_url();?>attendance/view_attendance/<?php echo $attend['id'];?>" class="btn btn-outline-success"><span class="oi oi-eye"></span></a>
                                     <a href="<?php echo base_url();?>attendance/on_remove/<?php echo $attend['id'];?>" class="btn btn-outline-danger"><span class="oi oi-trash"></span></a>
                                </td>

                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
               
               
            
            </div>
        </div>
          
        <?php else: ?>
            <div class="empty text-center">
                <p class="lead text-muted">Attendance list is empty</p>
            </div>
        <?php endif;?>
       
    </div>
</div>


<script>
    $('document').ready(function(){
        
        //Program conditions
        var program = $('#sort').val();
   

        if(localStorage.getItem('current_program')){

            var saved_program = localStorage.getItem('current_program')
            $('#sort').val(saved_program);
            
        }else{
            
            //Set date value
            $('#sort').val('All');
        }
       

        // Date conditions

        var default_date = $('#default_date').val();
        var search_value = $('#search_value').val();

        if(localStorage.getItem('current')){

            var saved_date = localStorage.getItem('current')
            $('#search_value').val(saved_date);
            
        }else{
            
            //Set date value
            $('#search_value').val(default_date);
        }



        //Default url
        var base_url = $('#base_url').val();
  
        var base_url = $('#base_url').val();
        $( "#search_value" ).change(function() {
            //alert();
            var search_param = $('#search_value').val();
            var url = base_url + 'attendance/?program='+ program + '&date='+search_param;

            localStorage.setItem('current',search_param);
            window.location.replace(url);
            
        });
        $( "#sort" ).change(function() {
          
            var sort = $('#sort').val();
            var url = base_url + 'attendance/?program='+ sort + '&date='+ default_date;
            localStorage.setItem('current_program',sort);
            window.location.replace(url);
            
        });
    });
</script>