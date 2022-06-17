<?php
include_once "./includes/header.php";
include_once "./class/Database.php";
include_once "./class/Product.php";

// get database connection
$database = new Database();
$db = $database->getConnection();
$productObj = new Product($db);

$products = $productObj->readAll("", 100);
?>

<body>
  <?php include_once "./includes/navbar.php" ?>


  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Album example</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
        <p>
          <a href="#" class="btn btn-primary my-2">Main call to action</a>
          <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p>
      </div>
    </div>
  </section>

  <div class="container d-flex justify-content-center flex-wrap">
    <?php foreach ($products as $product) : ?>
      <div class="card m-3 rounded p-1" style="width: 16rem;">
        <img src="<?= $product['thumbnail'] ?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?= $product["title"] ?></h5>
          <p style="margin-bottom: 5px;" class="card-text text-truncate"><?= $product["description"] ?></p>
          <h5 class="card-text text-danger">$<?= $product["price"] ?></h5>

          <form action="/cart/add.php" method="POST">
            <input name="quantity" type="number" value="1" min="1" , max="<?= $product["available"] ?>">
            <input class="visually-hidden" name="id" value="<?= $product['id'] ?>">
            <button class="btn btn-primary" type="submit">
              <i class="fa-solid fa-cart-circle-plus"></i> Add To Cart
            </button>
          </form>
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <?php include_once "./includes/footer.php"; ?>
</body>
