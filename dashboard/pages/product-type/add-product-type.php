<?php
// create edit product php
require_once "../../layout/header.php";

function add_product_type($data)
{
    global $conn;
    $name = $data["name"];

    $query = "INSERT INTO product_type (name)
                VALUES
            ('$name')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

if (isset($_POST['add'])) {
    if (add_product_type($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'product-type.php';
            </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<div class="row-cols-md-2">
    <div class="container mb-5">
        <div class="card">
            <div class="container-fluid px-5 py-2">
                <h2 class="py-4 text-center">Add Product Type</h2>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Product Type</label>
                        <input type="text" class="form-control" id="nama" name="name" required>
                    </div>

                    <div class=" modal-footer my-4">
                        <a href="product-type.php" type="button" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-dark ms-2" name="add">Add Product Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once "../../layout/footer.php";
?>