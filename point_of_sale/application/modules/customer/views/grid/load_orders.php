
<?php

if(!empty($orders)){
    $curr_date = date('Y-m-d');
    foreach($orders as $key => $value){ 
        $d_date = date('Y-m-d',strtotime($value->Deadline));
        ?>
    <tr  onClick="myFunction(<?=$value->ID?>, <?=$value->Cust_ID?>)" >
        <td><?=$key+1?></td>
        <td><?= date('M d, Y',strtotime($value->Book_date))?></td>
        <td class="<?= $curr_date >= $d_date ? 'text-danger text-bold':''?>"><?=date('M d, Y',strtotime($value->Deadline))?></td>
    </tr>

 <?php  
     }
} else { ?>
         <tr>
                <td colspan="8">
                    <div><center><h6>No data available in table.</h6></center></div>
                </td>
            </tr>
<?php }


?>
<?php load_table_css(); ?>
