<?php function drawCart(array $itemsByMenu){ ?>
    <header>
    <link rel="stylesheet" href="../css/cart.css">
    <script src="../javascript/cart.js" defer></script>
    </header>
    <section id="products">
    <article data-id="1">
      <h2>Gaming Console</h2>
      <img src="https://picsum.photos/200?1">
      <p class="price">200</p>
      <input class="quantity" type="number" value="1">
      <button class="buy">Buy</button>
    </article>
    <article data-id="2">
      <h2>Mobile Phone</h2>
      <img src="https://picsum.photos/200?2">
      <p class="price">150</p>
      <input class="quantity" type="number" value="1">
      <button class="buy">Buy</button>
    </article>
    <article data-id="3">
      <h2>Smartwatch</h2>
      <img src="https://picsum.photos/200?3">
      <p class="price">50</p>
      <input class="quantity" type="number" value="1">
      <button class="buy">Buy</button>
    </article>
    <article data-id="4">
      <h2>Laptop</h2>
      <img src="https://picsum.photos/200?4">
      <p class="price">525</p>
      <input class="quantity" type="number" value="1">
      <button class="buy">Buy</button>
    </article>
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