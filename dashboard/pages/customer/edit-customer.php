<?php
require_once "../../layout/header.php";

$id = $_GET['id'];
$customer = query("SELECT * FROM customer WHERE id = $id")[0];

function edit_customer($data)
{
    global $conn;
    $id = $data["id"];
    $name = $data["name"];
    $gender = $data["gender"];
    $phone = $data["phone"];
    $email = $data["email"];
    $address = $data["address"];

    $query = "UPDATE customer SET
                name = '$name',
                gender = '$gender',
                phone = '$phone',
                email = '$email',
                address = '$address'
                WHERE id = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



if (isset($_POST['edit'])) {
    if (edit_customer($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'customer.php?title=Customer';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah!');
                document.location.href = 'customer.php?title=Customer';
            </script>
        ";
    }
}

?>

<div class="row-cols-md-2">
    <div class="container mb-5">
        <div class="card">
            <div class="container-fluid px-5 py-2">
                <h2 class="py-4 text-center">Edit Customer</h2>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $customer['id']; ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $customer['name']; ?>" required>
                    </div>
                    <!-- gender -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <!-- select with option "L" or "P" -->
                        <select name="gender" id="gender" class="form-select" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <!-- phone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $customer['phone']; ?>" required>
                    </div>
                    <!-- email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $customer['email']; ?>" required>
                    </div>

                    <!-- address -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= $customer['address']; ?>" required>
                    </div>

                    <div class="modal-footer my-4">
                        <a href="customer.php?title=Customer" type="button" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-dark ms-2" name="edit">Edit Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once "../../layout/footer.php";
?>