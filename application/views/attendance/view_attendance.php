<div class="students">
    <div class="container">
       
        <div class="row">
            <?php if($details): ?>
                 <?php foreach($details as $detail):?>
                    <?php $created_time = date('F j, Y - g:i A', strtotime($detail['created_time'])); ?>
                    <div class="col-md-6">`
                         <h2 class="text-success"> <?php echo $detail['title']; ?></h2>
                        <h3><?php echo $created_time; ?></h3>
                         <?php if($detail['attendance_type'] == 2): ?>
                                <h2 class="text-info">Sign-in</h2>
                            <?php endif;?>
                           <?php if($detail['attendance_type'] == 3): ?>
                                <h2 class="text-danger">Sign-out</h2>
                           <?php endif;?>
                    </div>
                    <div class="col-md-3">
                        
                    </div>

                     <div class="col-md-3 text-right">
                     
                          <?php if($detail['status'] == 1): ?>
                            <div class="dropdown show">
                                <a class="btn btn-lg btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Active
                                </a>
                            
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="<?php echo base_url();?>attendance/deactivate/?attendance_id=<?php echo $detail['id'];?>">Deactivate</a>
                              
                                </div>
                            </div>
                           <?php else:?>
                                 <div class="dropdown show">
                                <a class="btn btn-lg btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Inactive
                                </a>
                            
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="<?php echo base_url();?>attendance/activate/?attendance_id=<?php echo $detail['id'];?>">Activate</a>
                              
                                </div>
                            </div>
                           <?php endif;?>
                        
                    </div>
                       
                 <?php endforeach;?>
             <?php endif;?>
        </div>
        <hr>
        <div class="row">
                <div class="col-md-4">
                      <?php if($students): ?>
                             <h4><span class="oi oi-person"></span> Students signed (<?php echo count($students);?>)</h4>
                        <?php else: ?>
                             <h4><span class="oi oi-person"></span> Students signed (0)</h4>
                        <?php endif; ?>
                  
                </div>
                <div class="col-md-4">
                    
                </div>
              
                <div class="col-md-4">
                    <div class="input-group">
                            <span class="input-group-addon">
                            Find
                            </span>
                            <input type="text" id="search_value" class="form-control" placeholder="Search..">
                            <input type="hidden" id="base_url" value="<?php echo base_url();?>attendance/view_attendance/<?php echo $detail['id'];?>">
                            <span class="input-group-addon">
                                <span id="search" class="oi oi-magnifying-glass"></span> 
                            </span>
                    </div>
                </div>

        </div>
        
        <?php if($students): ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Student</th>
                        <th>Time</th>
                        <th>Checked by</th>
                    </thead>
                    <tbody>
                        <?php foreach($students as $student):?>
                            <tr>
                                <td><?php echo $student['Name'] . ' '.$student['Lastname'] ;?></td>
                                <?php $created_time = date('g:i A', strtotime($student['attendance_time'])); ?>
                                <td><?php echo $created_time;?></td>
                                <td><?php echo $student['checker_name'];?></td>

                               

                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
               
               
            </div>
        <?php else: ?>
            <div class="empty text-center">
                <p class="lead text-muted"><span class="oi oi-person"></span> No students signed yet</p>
            </div>
        <?php endif;?>
       
    </div>
</div>

<script>
    $('document').ready(function(){

        var base_url = $('#base_url').val();
        $( "#search" ).click(function() {
            //alert();
            var search_param = $('#search_value').val();
            var u = base_url + '?search='+search_param;
            window.location.replace(u);
            
        });
      
    });
</script>