<?php
require_once "layout/header.php";


$product = query("SELECT * FROM product");
$customer = query("SELECT * FROM customer");

function order($data)
{
    global $conn;
    $name = $data["name"];
    $order_number = "PO00" . rand(1, 999);
    $date = date("Y-m-d H:i:s");
    $product_id = $data["product"];
    $qty = $data["qty"];

    $customer = query("SELECT * FROM customer WHERE name = '$name'");

    if ($customer == null) {
        $gender = rand(0, 1) == 1 ? "L" : "P";
        $address = "Depok";
        $email = strtolower(explode(" ", $name)[0]) . "@gmail.com";
        $phone = "08" . rand(100000000, 999999999);
        $card_id = rand(1, 3);

        $query = "INSERT INTO customer ( name,gender, phone, email, address, card_id )
                    VALUES 
                ('$name', '$gender', '$phone', '$email','$address', '$card_id')";

        mysqli_query($conn, $query);

        echo mysqli_error($conn);

        $customer = query("SELECT * FROM customer WHERE name = '$name'");
    }

    $customer = $customer[0]['id'];

    $product = query("SELECT * FROM product WHERE id = $product_id")[0];

    $total_price = $product['sell_price'] * $qty;

    $stock = $product['stock'] - $qty;

    $min_stock = $product['min_stock'];

    if ($stock < $min_stock) {
        echo "
            <script>
                alert('Stock tidak mencukupi!');
                document.location.href = 'checkout.php';
            </script>
        ";
        return false;
    }

    $query_product = "UPDATE product SET
                stock = '$stock'
                WHERE id = $product_id
            ";

    mysqli_query($conn, $query_product);



    $query = "INSERT INTO orders (order_number, date, qty, total_price, customer_id, product_id)
                VALUES
            ('$order_number','$date',  '$qty',$total_price, $customer, '$product_id')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

if (isset($_POST["checkout"])) {
    if (order($_POST) > 0) {
        echo "
            <script>
                alert('Checkout berhasil!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<section class="d-flex justify-content-center" style="max-width: 600px; margin:5rem auto ">
    <form class="text-primary-color w-100 px-5" action="" method="POST">
        <h1 class="my-3 text-center">Order Product</h1>

        <div class="form-outline mb-4">
            <label class="form-label" for="name">Customer</label>
            <input type="text" id="name" class="form-control" name="name" required />
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="product">Product</label>
            <select name="product" id="product" class="form-select">
                <?php foreach ($product as $p) : ?>
                    <option value="<?= $p['id']; ?>"><?= $p['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example2">Qty</label>
            <input type="number" min="0" id="form1Example2" class="form-control" name="qty" required />
        </div>

        <button type="submit" class="btn btn-primary-color w-100 mt-3" name="checkout">Checkout</button>
    </form>
</section>

<?php require_once "layout/footer.php" ?>