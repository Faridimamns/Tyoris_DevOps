<?php

require '../../../db.php';

function delete($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM orders WHERE customer_id = $id");
    mysqli_query($conn, "DELETE FROM customer WHERE id = $id");


    return mysqli_affected_rows($conn);
};

$id = $_GET['id'];

if (delete($id) > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'customer.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'customer.php';
        </script>
    ";
}
