<?php declare(strict_types = 1); ?>


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
      <tfoot>
        <tr><th colspan="5">Total:</th><th>0</th></tr>
      </tfoot>
    </table>
  </section>
<?php }?>