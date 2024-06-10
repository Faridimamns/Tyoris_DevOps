<?php
require_once "../../layout/header.php";
$product_type = query("SELECT * FROM product_type");
?>

<div class="d-flex justify-content-end mb-3">
    <a href="add-product-type.php" class="btn btn-primary">Add Product Type</a>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Data Product Type
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($product_type as $p) : ?>
                    <tr>
                        <td><?= $p["id"]; ?></td>
                        <td><?= $p["name"]; ?></td>
                        <td>
                            <a href="edit-product-type.php?id=<?= $p['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete-product-type.php?id=<?= $p['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?')">Delete</a>
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