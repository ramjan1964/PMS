<?php
require_once '../db_config.php';


// Fetch knitting order data
$orderSql = "SELECT * FROM knitting_order";
$orderResult = $conn->query($orderSql);

require_once 'header.php';
?>

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
                <li><i class="fa fa-tasks" aria-hidden="true"></i><a href="javascript:avoi(0)">userlist</a></li>
            </ul>
        </div>
    </div>

    <div class="row animated fadeInUp">
        <div class="col-sm-12">
        
                <!-- Knitting Order List -->
            <div class="panel">
            
                <div class="panel-content">
                    <h5>Knitting Order List</h5>
                    <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover dataTable no-footer table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Buyer</th>
                            <th>Style</th>
                            <th>Program No</th>
                            <th>Fabric No</th>
                            <th>Fabric Type</th>
                            <th>Fabric Color</th>
                            <th>Req. Qty</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Currency</th>
                            <th>Swatch Path</th>
                            <th>Order Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
if ($orderResult->num_rows > 0) {
    while ($orderRow = $orderResult->fetch_assoc()) {
        echo "<tr>
                <td>{$orderRow['buyer']}</td>
                <td>{$orderRow['style']}</td>
                <td>{$orderRow['Program_no']}</td>
                <td>{$orderRow['fabric_no']}</td>
                <td>{$orderRow['fabric_type']}</td>
                <td>{$orderRow['fabric_color']}</td>
                <td>{$orderRow['required_qty']}</td>
                <td>{$orderRow['unit']}</td>
                <td>{$orderRow['price']}</td>
                <td>{$orderRow['amount']}</td>
                <td>{$orderRow['currency']}</td>
                <td><img src='../images/knitting/{$orderRow['swatch_path']}' alt='Swatch' style='max-height: 100px;'></td>
                <td>{$orderRow['order_date']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='14'>No knitting orders found</td></tr>";
}
?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Knitting Order List -->
        </div>
    </div>

        <!--scroll to top-->
        <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>
</div>

<?php
require_once 'footer.php';
?>
