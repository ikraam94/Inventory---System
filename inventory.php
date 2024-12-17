<?php include 'session_check.php'; ?>
<?php include('layout/header.php'); ?>
<?php include('db_connection.php');

$query = "
SELECT 
    inventory.id,
    inventory.sn_no,
    inventory.item_name,
    inventory.item_desc,
    inventory.img,
    inventory.qty,
    inventory.created_at,
    inventory.category_id,
    category.name AS category_name
FROM 
    inventory
JOIN 
    category ON inventory.category_id = category.id
";
$result = mysqli_query($conn, $query);

?>
<div id="layoutSidenav_content">
    <main>
        <?php
        if (isset($_GET['update']) && $_GET['update'] == 'success') {
            echo "<div class='alert alert-success'>Inventory updated successfully!</div>";
        }

        if (isset($_GET['update']) && $_GET['update'] == 'deleted') {
            echo "<div class='alert alert-danger'>Inventory deleted successfully!</div>";
        }
        ?>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Inventory</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">This is the inventory page where you are able to create, update, and delete items</li>
            </ol>
            <div class="row">
                <div class="col-12 mb-3 text-end">
                    <a href="/inventory-system/create-inventory.php" class="btn btn-primary text-white ">Create Item</a>
                </div>
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            All Inventory
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Item Name</th>
                                        <th>Item Desc</th>
                                        <th>Img</th>
                                        <th>Category</th>
                                        <th>Qty</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>SN</th>
                                        <th>Item Name</th>
                                        <th>Item Desc</th>
                                        <th>Img</th>
                                        <th>Category</th>
                                        <th>Qty</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($result as $r): ?>
                                        <tr>
                                            <td><?php echo $r['sn_no']; ?></td>
                                            <td><?php echo $r['item_name']; ?></td>
                                            <td><?php echo $r['item_desc']; ?></td>
                                            <td>
                                                <?php if (!empty($r['img'])) { ?>
                                                    <a href="/inventory-system/<?php echo $r['img']; ?>" target="_blank"><u>Click Here for The Img</u></a>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $r['category_name']; ?></td>
                                            <td><?php echo $r['qty']; ?></td>
                                            <td><?php echo $r['created_at']; ?></td>
                                            <td>
                                                <a href="/inventory-system/edit-inventory.php?id=<?php echo $r['id']; ?>" class="btn btn-warning">Edit</a>
                                                <a href="/inventory-system/delete-inventory.php?id=<?php echo $r['id']; ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>
<?php include('layout/footer.php'); ?>