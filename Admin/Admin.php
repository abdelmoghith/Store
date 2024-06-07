<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="all.min.css" />
    <link rel="stylesheet" href="hide.css" />
    <title>Admin</title>
  </head>
  <body>
    <div class="left">
      <div class="logo"></div>
      <div class="icons">
        <a href="Admin.php">
          <div class="" >
            <i class="fa-solid fa-house"></i>
            <p>dashbord</p>
          </div>
        </a>
        <a href="Client.php">
          <div class="">
            <i class="fa-solid fa-user-group"></i>
            <p>Client</p>
          </div>
        </a>
        <a href="Orders.php">
          <div class="">
            <i class="fa-solid fa-basket-shopping"></i>
            <p>Orders</p>
          </div>
        </a>
        <div class="just" style="display: block">
          <div class="" style="display: flex">
            <i class="fa-solid fa-cart-shopping"></i>
            <p>Product</p>
            <i class="fa-solid fa-chevron-down"></i>
          </div>
          <div class="list">
            <ul>
              <a href="Category.php" id="act">
                <li><i class="fa-solid fa-list"></i><span>Category</span></li>
              </a>
              <a href="Product.php">
                <li><i class="fa-regular fa-eye"></i> <span>View</span></li>
              </a>
            </ul>
          </div>
        </div>
        <!-- <a href="">
          <div class="list"></div>
        </a> -->

        <a href="Login.php">
          <div class="">
            <i class="fa-solid fa-right-from-bracket"></i>
            <p>Logout</p>
          </div>
        </a>
      </div>
    </div>
    <div class="right">
      <div class="navbar">
        <div class="new">
          <input type="text" placeholder="Searsh " />
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <div class=""><i class="fa-solid fa-bell"></i></div>
      </div>
      <div class="contain">
        <div class="grid">
          <div class="grid-left">
            <div class="">
              <div id="img1"></div>
              <p>Total Clients</p>
              <p>27</p>
              <!-- <a href="">View All <i class="fa-solid fa-angle-right"></i></a> -->
            </div>
            <div class="">
              <div id="img2"></div>
              <p>Total Revenue</p>
              <p>$ 23.890</p>
              <!-- <a href="">View All <i class="fa-solid fa-angle-right"></i></a> -->
            </div>
            <div class="">
              <div id="img3"></div>
              <p>Total Order</p>
              <p>54</p>
              <!-- <a href="">View All <i class="fa-solid fa-angle-right"></i></a> -->
            </div>
            <div class="">
              <div id="img4"></div>
              <p>Total Products</p>
              <p>253</p>
              <!-- <a href="">View All <i class="fa-solid fa-angle-right"></i></a> -->
            </div>
          </div>
        </div>

        <div class="gridx">
          <div class="grid-leftx">
            <h3>Recent Orders</h3>
            <table>
              <thead>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Stock</th>
              </thead>
              <tbody>
                <tr>
                  <td><div class="Product"></div></td>
                  <td>$200</td>
                  <td>20</td>
                  <td>1000</td>
                </tr>
               
              </tbody>
            </table>
          </div>
          <div class="grid-right">
            <h3>Best Sellers</h3>
            <table>
              <thead>
                <th>Product</th>
                <th>Price</th>
              </thead>
              <tbody>
                <tr>
                  <td><div class="Product_1"></div></td>
                  <td>$200</td>
                </tr>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script src="admin.js"></script>
</html>
