<?php declare(strict_types = 1);
require_once('../database/menu_item.class.php'); 

?>


<?php function drawCart(array $itemsByMenu){ ?>
    <header>
    <link rel="stylesheet" href="../css/cart.css">
    <script src="../javascript/cart.js" defer></script>
    </header>
    <section id="products">
    <?php if ($itemsByMenu!=[]){ ?>
    <?php foreach ($itemsByMenu as $i => $item) { ?>
    <article data-id="<?=$i+1?>">
      <h2><?=$item->name?></h2>
      <img src="../itemPictures/<?=$item->photo?>">
      <p class="price"><?=$item->price?></p>
      <input class="quantity" type="number" value="1">
      <button class="buy">Buy</button>
    </article>
    <?php } ?>
  <?php } else{?>
  <h4>This restaurant doesn't have any items</h4> <?php }?>
  </section>
  <h2>Shopping Cart</h2>
  <section id="cart">
    <table>
      <thead>
        <tr><th>Id</th><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th><th>Delete</th></tr>
      </thead>
      <tbody id="tbody">
      <?php $total = 0; foreach ($_SESSION['cart'] as $i => $item) { $total+=$item['price']*$item['quantity'];?>
          <tr id="<?=$i?>"><th><?=$i?></th><th><?php $db = getDatabaseConnection(); ?><?=Menu_Item::getItemName($db,$i)?></th><th><?=$item['quantity']?></th><th><?=$item['price']?></th>
          <th><?=$item['price']*$item['quantity']?></th> <th><a href="javascript:DeleteRow()">X</a></th></tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr><th colspan="5">Total:</th><th><?=$total?></th></tr>
      </tfoot>
    </table>
  </section>
<?php }?>