<?php

require 'layout/header.php';

$id = $_GET['id'];
$product = query("SELECT * FROM product WHERE id = $id")[0];

?>


<div class="container p-5">
    <div class="row row-cols-1 g-4" style="max-width: 500px; margin:auto">
        <div class="col">
            <div class="card">
                <img src="assets/img/product-<?= $id; ?>.jpg" class="card-img-top" alt="<?= $product["name"]; ?> Image" />
                <div class="card-body">
                    <h5 class="card-title"><?= $product["name"]; ?></h5>
                    <p class="card-text mb-1">
                        Price : Rp. <?= number_format($product["sell_price"], 2, ",", "."); ?>
                    </p>
                    <p class="card-text">
                        Stock : <?= $product["stock"]; ?>
                    </p>
                    <a href="index.php" class="btn btn-secondary">Back</a>
                    <a href="order.php" class="btn btn-primary">Buy</a>

                </div>
            </div>
        </div>
    </div>
</div>

<?php

require 'layout/footer.php';

?>