<div class="checkers">
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

         
        <div class="row toolbar">
             <div class="col-md"><h4><span class="oi oi-people"></span> <?= $title ?> (<?php echo $count_all;?>)</h4></div>
             
        </div>
        <hr>
        <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                            <a href="<?php echo base_url();?>checkers/add_checker" class="btn btn-outline-success"><span class="oi oi-plus"></span> New</a>
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
        
        <?php if($checkers): ?>
            <div class="card">         
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>Program</th>
                            <th>Username</th>
                            <th>Password (Encrypted)</th>
                            <th class="text-center">Options</th>
                        </thead>
                        <tbody> 
                            <?php foreach($checkers as $checker):?>
                                <tr>
                                    <td><?php echo $checker['checker_name'];?></td>
                                    <td><?php echo $checker['program'];?></td>
                                    <td><?php echo $checker['checker_username'];?></td>
                                    <td><?php echo $checker['checker_password'];?></td>
                                    <td class="text-center"> <a href="<?php echo base_url();?>checkers/edit_checker/<?php echo $checker['checker_id'];?>" class="btn btn btn-outline-info"><span class="oi oi-pencil"></span></a>
                                    <input type="hidden" id="checker_id" value="<?php echo $checker['checker_id'];?>">
                                    <a id="remove" href="<?php echo base_url();?>checkers/remove_checker/<?php echo $checker['checker_id'];?>/<?php echo $checker['checker_username'];?>" class="btn btn btn-outline-danger"><span class="oi oi-trash"></span></a></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>      
                </div>
            </div>    
        <?php else: ?>
            <div class="empty text-center">
                <p class="lead text-muted"> No checkers added yet</p>
            </div>
        <?php endif;?>
       
    </div>
</div>

<script>
    
 


    $('document').ready(function(){

      //Default url
        var base_url = $('#base_url').val();
        $( "#search" ).click(function() {
            //alert();
            var search = $('#search_value').val();
            var url = base_url + 'checkers/?search='+ search;
            window.location.replace(url);

        });


    });
</script>