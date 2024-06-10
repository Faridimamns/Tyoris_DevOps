<?php

require_once "../../../db.php";

$id = $_GET['id'];

function delete($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM product_type WHERE id = $id");

    return mysqli_affected_rows($conn);
};

if (delete($id) > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'product-type.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'product-type.php';
        </script>
    ";
}
