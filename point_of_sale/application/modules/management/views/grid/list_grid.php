<?php
    $prevCat = '';
    foreach($list as $key => $value){ 
    ?>
    <tr>
        <td>
            <?php
                if($prevCat == $value->List_category) {
                    $Cat = '';
                } else {
                    $Cat = $prevCat = $value->List_category;
                }
                echo $Cat;
            ?>
        </td>
        <td><?=ucfirst($value->List_name)?></td>
    </tr>
<?php   
}

?>