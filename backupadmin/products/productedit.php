<?php
include '../includes/config.php';
$id = "";
$p_name = "";
$p_price = "";
$p_qty = "";


$erroMessage = "";
$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //show the method of the employee
    if (!isset($_GET["id"])) {
        header("location: profile.php");
        exit;
    }
    $id = $_GET["id"];

    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: profile.php");
        exit;
    }

    $p_name = $row["p_name"];
    $p_price = $row["p_price"];
    $p_qty = $row["p_qty"];
} else {
    $id = $_POST["id"];
    $p_name = $_POST["p_name"];
    $p_price = $_POST["p_price"];
    $p_qty = $_POST["p_qty"];



    do {
        if (empty($id) || empty($p_name) || empty($p_price) || empty($p_qty)) {
            $erroMessage = "ALL the fields are required";
            break;
        }
        $sql = "UPDATE products " . // added space after "employee"
            "SET p_name = '$p_name', p_price = '$p_price', p_qty = '$p_qty'" . // added spaces after each comma
            "WHERE id = $id";

        $result = $conn->query($sql);
        if (!$result) {
            $erroMessage = "invalid query:" . $conn->error;
            break;
        }
        $succesMessage = "employ updated correctly";

        header("location: productsindex.php");
        exit;
    } while (true);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php
    if (!empty($erroMessage)) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>$erroMessage</strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
 
    </button>
  </div>";
    }


    ?>
<a class="btn btn-primary" href="/project3.0/admin/products/productsindex.php">back</a>


    <div class="container my-5">

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">Product Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="p_name" value="<?php echo $p_name; ?>">
                </div>
            </div>
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">product price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="p_price" value="<?php echo $p_price; ?>">
                </div>
            </div>
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">product qty</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="p_qty" value="<?php echo $p_qty; ?>">
                </div>

            </div>

            <?php
            if (!empty($succesMessage)) {
                echo "
    <div class='row md-3'>
                <div class='offset-sm-3 col-sm-6'>
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>$succesMessage</strong> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
</div>
</div>
    </button>
  </div>";
            }


            ?>

            <div class="row md-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>