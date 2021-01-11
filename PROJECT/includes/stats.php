<?php

$id=$_SESSION['user'];
$DB = DB::getInstance()->get('stats', array('id', '=', $id));
$results=$DB->results();
//print_r($results);


?>

 <table class="table table-hover">
  <thead class="thead-white">
    <tr>
      <th scope="col">Level</th>
      <th scope="col">Completion Date</th>
    </tr>
  </thead>
  <tbody>


<?php  for($i=0;$i<count($results);$i++){?>     


    <tr>
      <th scope="row"><?php echo $i ?></th>
      <td><?php echo ($results[$i]->fintime);?></td>
    </tr>
    

    <?php } ?>
  </tbody>
</table>