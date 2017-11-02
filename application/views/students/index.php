<div class="students">
    <div class="container">

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
        <div class="row toolbar">
             <div class="col-md-4"><h4><span class="oi oi-people"></span> Students (<?php echo $count_all;?>)</h4></div>
        </div>
        <hr>
        <div class="row">
             <div class="col-md-4">
                    <div class="input-group">
                            <a href="<?php echo base_url();?>students" class="btn btn-info">Show all</a>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
              
                <div class="col-md-4">
                    <div class="input-group">
                            <input type="text" id="search_value" class="form-control" placeholder="Search..">
                            <input type="hidden" id="base_url" value="<?php echo base_url();?>">
                            <span class="input-group-addon">
                                <span id="search" class="oi oi-magnifying-glass"></span> 
                            </span>
                    </div>
                </div>
        </div>
        
        <?php if($students): ?>
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th><span class="oi oi-key"></span> ID #</th>
                            <th><span class="oi oi-person"></span> Full name</th>
                            <th>Course</th>
                            <th><span class="oi oi-project"></span>  Barcode</th>
                            <th class="text-center"><span class="oi oi-cog"></span></th>
                        </thead>
                        <tbody>
                            <?php foreach($students as $student):?>
                                <tr>
                                    <td><?php echo $student['IdNos'];?></td>
                                    <td><?php echo $student['Name'].' '.$student['Lastname'];?></td>
                                    <td><?php echo $student['Course'];?></td>
                                    <td><?php echo $student['Barcode'];?></td>
                                    <td class="text-center"> <a href="<?php echo base_url();?>students/view_student/<?php echo $student['id'];?>/<?php echo $student['Lastname'];?>" class="btn btn btn-outline-success"><span class="oi oi-person"></span></a>
                                        <a href="<?php echo base_url();?>students/edit_student/<?php echo $student['id'];?>" class="btn btn btn-outline-info"><span class="oi oi-pencil"></span></a></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
           
        <?php else: ?>
        <div class="empty text-center">
                <p class="lead text-muted"> No students found</p>
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
            var u = base_url + 'students?search='+search_param;
            window.location.replace(u);
            
        });
        $( "#course" ).change(function() {
            //alert();
            var course = $('#course').val();
            var u = base_url + 'students?course='+course;
            window.location.replace(u);
            
        });
    });
</script>