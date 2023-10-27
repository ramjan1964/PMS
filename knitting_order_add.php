<?php
require_once 'header.php';

// Initialize variables for error messages
$success = $error = '';

// Check if the form is submitted
if (isset($_POST['save_order'])) {
    // ... (your existing code to retrieve form data)
    $buyer = $_POST['buyer'];
    $style = $_POST['style'];
    $programNo = $_POST['Program_no'];
    $fabricNo = $_POST['fabric_no'];
    $fabricType = $_POST['fabric_type'];
    $fabricColor = $_POST['fabric_color'];
    $requiredQty = $_POST['required_qty'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];
    // Convert $price and $requiredQty to numbers
    $price = floatval($price);
    $requiredQty = floatval($requiredQty);
    // Calculate amount based on price and required_qty
    $amount = $price * $requiredQty;
    $currency = $_POST['currency'];
    // Extract file extension using pathinfo
   // Extract file extension using pathinfo
$swatch = explode('.', $_FILES['swatch_path']['name']);
$swatch_ext = end($swatch);
$swatch = date('Ymdhis.') . $swatch_ext;
$orderDate = $_POST['orderdate'];

    // Check for empty fields
    $required_fields = ['buyer', 'style', 'Program_no', 'fabric_no', 'fabric_type', 'fabric_color', 'required_qty', 'unit', 'price', 'currency', 'orderdate'];
    $empty_fields = [];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $empty_fields[] = ucfirst(str_replace('_', ' ', $field));
    }
}

    if (!empty($empty_fields)) {
        $error = "Please fill in the following fields: " . implode(', ', $empty_fields);
    } else {
        // Insert data into the database
        $result = mysqli_query($conn, "INSERT INTO knitting_order (buyer, style, Program_no, fabric_no, fabric_type, fabric_color, required_qty, unit, price, amount, currency, swatch_path, order_date)
            VALUES ('$buyer', '$style', '$programNo', '$fabricNo', '$fabricType', '$fabricColor', '$requiredQty', '$unit', '$price', '$amount', '$currency', '$swatch', '$orderDate')");

if ($result) {
    $destination = '../images/knitting/' . $swatch;
    
    if (move_uploaded_file($_FILES["swatch_path"]["tmp_name"], $destination)) {
        $success = "Order saved successfully!";
    } else {
        $error = "Error moving uploaded file to destination.";
    }
} else {
    $error = "Error while saving order: " . mysqli_error($conn);
}

    }
}

?>

<!-- Rest of your HTML code -->

<!-- CONTENT -->
<!-- ========================================================= -->
<div class="content">
    <!-- content HEADER -->
    <!-- ========================================================= -->
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                <li><i class="fa fa-tasks" aria-hidden="true"></i><a href="javascript:avoi(0)">Add knitting Order</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

    <div class="row animated fadeInUp">
        <!--SETTINGS-->

        <div class="col-sm-6 col-sm-offset-3">
            <!-- Display success or error message -->
            <?php if (!empty($success)): ?>
                <div class="alert alert-success" role="alert">
                    <?= $success ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <h4 class="section-subtitle"><b>knitting Order</b></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                <h4 class="mb-lg">Add knitting Order</h4>

                                <div class="form-group">
    <label for="buyer" class="col-sm-4 control-label">Buyer:</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="buyer" name='buyer' placeholder="Type the buyer Name"
               value="<?= isset($buyer) ? $buyer : '' ?>">
    </div>
</div>

<div class="form-group">
    <label for="style" class="col-sm-4 control-label">Style:</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="style" name='style' placeholder="Type the style No"
               value="<?= isset($style) ? $style : '' ?>">
    </div>
</div>

<div class="form-group">
    <label for="Program_no" class="col-sm-4 control-label">Program No:</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="Program_no" name='Program_no' placeholder="Type the Program No"
               value="<?= isset($programNo) ? $programNo : '' ?>">
    </div>
</div>

<div class="form-group">
    <label for="fabric_no" class="col-sm-4 control-label">Fabric No:</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="fabric_no" name='fabric_no' placeholder="Type the Fabric No"
               value="<?= isset($fabricNo) ? $fabricNo : '' ?>">
    </div>
</div>

<div class="form-group">
    <label for="fabric_type" class="col-sm-4 control-label">Fabric Type:</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="fabric_type" name='fabric_type' placeholder="Type the Fabric Type"
               value="<?= isset($fabricType) ? $fabricType : '' ?>">
    </div>
</div>

<div class="form-group">
    <label for="fabric_color" class="col-sm-4 control-label">Fabric Color:</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="fabric_color" name='fabric_color' placeholder="Type the Fabric Color"
               value="<?= isset($fabricColor) ? $fabricColor : '' ?>">
    </div>
</div>

<div class="form-group">
    <label for="required_qty" class="col-sm-4 control-label">Req. Qty:</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="required_qty" name='required_qty'
               placeholder="Type the required Fabric Qty" value="<?= isset($requiredQty) ? $requiredQty : '' ?>">
    </div>
</div>

<div class="form-group">
    <label for="unit" class="col-sm-4 control-label">Unit:</label>
    <div class="col-sm-8">
        <select class="form-control" id="unit" name="unit">
            <option value="usd" <?= isset($unit) && $unit === 'usd' ? 'selected' : '' ?>>KG</option>
            <option value="eur" <?= isset($unit) && $unit === 'eur' ? 'selected' : '' ?>>GM</option>
            <option value="gbp" <?= isset($unit) && $unit === 'gbp' ? 'selected' : '' ?>>M.Ton</option>
            <!-- Add more currency options as needed -->
        </select>
    </div>
</div>

<div class="form-group">
    <label for="price" class="col-sm-4 control-label">Price:</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="price" name='price' placeholder="Type the price"
               value="<?= isset($price) ? $price : '' ?>">
    </div>
</div>

<div class="form-group">
    <label for="amount" class="col-sm-4 control-label">Amount:</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="amount" name='amount' placeholder="amount"
               readonly value="<?= isset($amount) ? $amount : '' ?>">
    </div>
</div>

<div class="form-group">
    <label for="currency" class="col-sm-4 control-label">Currency:</label>
    <div class="col-sm-8">
        <select class="form-control" id="currency" name="currency">
            <option value="taka" <?= isset($currency) && $currency === 'taka' ? 'selected' : '' ?>>TAKA</option>
            <option value="usd" <?= isset($currency) && $currency === 'usd' ? 'selected' : '' ?>>USD</option>
            <option value="eur" <?= isset($currency) && $currency === 'eur' ? 'selected' : '' ?>>EUR</option>
            <option value="gbp" <?= isset($currency) && $currency === 'gbp' ? 'selected' : '' ?>>GBP</option>
            <!-- Add more currency options as needed -->
        </select>
    </div>
</div>

<div class="form-group">
    <label for="swatch_path" class="col-sm-4 control-label">Swatch:</label>
    <div class="col-sm-8">
        <input type="file" class="form-control" id="swatch_path" name='swatch_path'>
    </div>
</div>

<div class="form-group">
    <label for="orderdate" class="col-sm-4 control-label">Order Date:</label>
    <div class="col-sm-8">
        <input type="date" class="form-control" id="orderdate" name='orderdate'
               value="<?= isset($orderdate) ? $orderdate : '' ?>">
    </div>
</div>


                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button type="submit" class="btn btn-primary" name="save_order"><i
                                                class="fa fa-save"></i>
                                            Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

        <!--scroll to top-->
        <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>
</div>

<?php
require_once 'footer.php';
?>