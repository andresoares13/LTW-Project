<?php function drawProfileRequests(array $requests) { ?>
  <h2>Orders of your restaurants:</h2>
  <h3>click on the order to see details and edit state</h3>
  <?php if ($requests!=[]){ ?>     
  <table id="tables">
    <tr><th scope="col">#</th><th scope="col">Customer</th><th scope="col">Restaurant</th><th scope="col">State</th></tr>
    <?php foreach ($requests as $i => $request) { ?>
      <tr><td><a href="../pages/request.php?id=<?=$request->id?>"> Order <?=$i+1?> </a> </td><td><?=$request->customer?></td><td><?=$request->restaurant?></td><td><?=$request->state?></td></tr> 
    <?php } ?>
  </table>
  <?php } else{?>
  <h4>No orders yet</h4> <?php }?> 
<?php } ?>