<?php
require_once "../../layout/header.php";
$product = query("SELECT * FROM product");
?>

<div class="d-flex justify-content-end mb-3">
    <a href="add-product.php" class="btn btn-primary">Add Item</a>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Data Product
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Purchase Price</th>
                    <th>Sell Price</th>
                    <th>Stock</th>
                    <th>Min Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($product as $p) : ?>
                    <tr>
                        <td><?= $p["sku"]; ?></td>
                        <td><?= $p["name"]; ?></td>
                        <td><?= $p["purchase_price"]; ?></td>
                        <td><?= $p["sell_price"]; ?></td>
                        <td><?= $p["stock"]; ?></td>
                        <td><?= $p["min_stock"]; ?></td>
                        <td>
                            <a href="edit-product.php?id=<?= $p['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete-product.php?id=<?= $p['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</main>

<?php require_once "../../layout/footer.php" ?>