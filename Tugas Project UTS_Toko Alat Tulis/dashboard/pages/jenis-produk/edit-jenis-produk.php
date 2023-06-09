<?php
require_once "../../layout/header.php";

$id = $_GET['id'];
$merk = query("SELECT * FROM merk WHERE id = $id")[0];

function edit_merk($data)
{
    global $conn;

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);

    $query = "UPDATEmerk SET
                nama = '$nama'
                WHERE id = $id
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

if (isset($_POST['edit'])) {
    if (edit_merk($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'jenis-produk.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah!');
                document.location.href = 'merk.php';
            </script>
        ";
    }
}



?>

<div class="row-cols-md-2">
    <div class="container mb-5">
        <div class="card">
            <div class="container-fluid px-5 py-2">
                <h2 class="py-4 text-center">Edit Item</h2>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $merk['id']; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Product Type</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $merk["nama"]; ?>" required>
                    </div>

                    <div class=" modal-footer my-4">
                        <a href="jenis-produk.php" type="button" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-dark ms-2" name="edit">Edit Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once "../../layout/footer.php";
?>