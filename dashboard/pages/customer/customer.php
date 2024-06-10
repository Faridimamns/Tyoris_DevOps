<?php
require_once "../../layout/header.php";
$customer = query("SELECT a.*,b.name as card_name FROM customer a INNER JOIN card b ON a.card_id=b.id");
?>

<div class="d-flex justify-content-end mb-3">
    <a href="add-customer.php" class="btn btn-primary">Add Customer</a>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Data Customer
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Card</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customer as $cust) : ?>
                    <tr>
                        <td><?= $cust["name"]; ?></td>
                        <td><?= $cust["gender"]; ?></td>
                        <td><?= $cust["phone"]; ?></td>
                        <td><?= $cust["email"]; ?></td>
                        <td><?= $cust["address"]; ?></td>
                        <td><?= $cust["card_name"]; ?></td>
                        <td>
                            <a href="edit-customer.php?id=<?= $cust['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete-customer.php?id=<?= $cust['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?')">Delete</a>
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