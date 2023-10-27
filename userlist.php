<?php
require_once '../db_config.php';
// Fetch user data from the database
$sql = "SELECT * FROM user";
$result = $conn->query($sql);
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
            <!-- DataTable -->
            <div class="panel">
                <div class="panel-content">
                    <!-- Add a container div with a fixed width and overflow-x: auto; it allow to scrolling vertically -->
                    <!-- <div style="width: 100%; overflow-x: auto;"> -->
                    <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover dataTable no-footer table-bordered" cellspacing="0" width="100%">
                            
                            <thead>
                                <tr>
                                    <th>Official ID</th>
                                    <th>User</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Joining Date</th>
                                    <th>Date of Birth</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['official_id']}</td>
                <td>" . ucwords($row['user']) . "</td>
                <td>{$row['designation']}</td>
                <td>{$row['department']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['joinning_date']}</td>
                <td>{$row['date_of_birth']}</td>
                <td><img src='{$row['image']}' alt='photo of {$row['user']}'></td>
                <td>" . ($row['status'] == 1 ? 'Active' : 'Inactive') . "</td>
                <td>" . ($row['status'] == 1 ? "<a href='status_inactive.php?id=" . base64_encode($row['id']) . "' class='btn btn-warning'><i class='fa fa-arrow-down'></i></a>" : "<a href='status_active.php?id=" . base64_encode($row['id']) . "' class='btn btn-primary'><i class='fa fa-arrow-up'></i></a>") . "</td>

                </tr>";
    }
} else {
    echo "<tr><td colspan='12'>No users found</td></tr>";
}
?>


                            </tbody>
                        </table>
                    </div>
                </div>
       </div>
            <!-- End DataTable -->
        </div>
                <!--scroll to top-->
                <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>

</div>

<?php
require_once 'footer.php';
?>