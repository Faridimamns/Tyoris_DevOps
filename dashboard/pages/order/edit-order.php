<?php
// create edit product php
require_once "../../layout/header.php";
$id = $_GET['id'];
$order = query("SELECT * FROM orders WHERE id = $id")[0];

function edit_order($data)
{
    global $conn;
    $id = $data["id"];
    $order_number = $data["order_number"];
    $qty = $data["qty"];
    $total_price = $data["total_price"];

    $query = "UPDATE orders SET
                order_number = '$order_number',
                qty = '$qty',
                total_price = '$total_price'
                WHERE id = $id
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


if (isset($_POST['edit'])) {
    if (edit_order($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diedit!');
                document.location.href = 'order.php?title=Order';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diedit!');
                document.location.href = 'order.php?title=Order';
            </script>
        ";
    }
}

?>

<div class="row-cols-md-2">
    <div class="container mb-5">
        <div class="card">
            <div class="container-fluid px-5 py-2">
                <h2 class="py-4 text-center">Edit Order</h2>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $order['id']; ?>">
                    <div class="mb-3">
                        <label for="order_number" class="form-label">Order Number</label>
                        <input type="text" class="form-control" id="order_number" name="order_number" value="<?= $order['order_number']; ?>" required>
                    </div>
                    <!-- qty -->
                    <div class="mb-3">
                        <label for="qty" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="qty" name="qty" value="<?= $order['qty']; ?>" required>
                    </div>
                    <!-- total_price -->
                    <div class="mb-3">
                        <label for="total_price" class="form-label">Total Price</label>
                        <input type="number" class="form-control" id="total_price" name="total_price" value="<?= $order['total_price']; ?>" required>
                    </div>

                    <div class="modal-footer my-4">
                        <a href="order.php?title=Order" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-dark ms-2" name="edit">Edit Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once "../../layout/footer.php";
?>