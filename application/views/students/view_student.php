<div class="students">
    <div class="container">
       
        <div class="row">
            <?php if($student): ?>
                    <?php foreach($student as $stud): ?>
                        <div class="col-md-4">
                            <h4 >ID #: <?php echo $stud['IdNos']; ?> </h4>
                            <h4 >Name: <?php echo $stud['Name'] . $stud['Lastname']; ?> </h4>
                        </div>
                        <div class="col-md-4">
                          
                        </div>
                        <div class="col-md-4 text-right">
                            <h4>Course: <?php echo $stud['Course']; ?> </h4>
                        </div>
                    <?php endforeach;?>
            <?php endif; ?>
          
        </div>
        <hr>
       
        <?php if($details): ?>
            <h4 class="text-muted text-center">Student attendance records</h4> 
            <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Attendance title</th>
                        <th>Attendance date and time</th>
                        <th>Time checked</th>
                        <th>Checked by</th>
                    </thead>
                    <tbody>
                        <?php foreach($details as $detail):?>
                            <tr>
                                <td><?php echo $detail['title'];?></td>
                                <?php $attendance_date = date('F j, Y g:i A', strtotime($detail['created_time'])); ?>
                                <?php $attendance_time = date('g:i A', strtotime($detail['attendance_time'])); ?>
                                    <td><?php echo $attendance_date;?></td>
                                    <td><?php echo $attendance_time;?></td>
                                    <td><?php echo $detail['checker_name'];?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
               
               
            </div>
                  
            </div>
        <?php else: ?>
            <div class="empty text-center">
                <p class="lead text-muted"><span class="oi oi-person"></span> No attendance records</p>
            </div>
        <?php endif;?>
       
    </div>
</div>

<script>
  
</script>