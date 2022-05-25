<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_order WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $id = $row['id'];
        // $price = $row['price'];
        // $qty = $row['qty'];
        $order_date = $row['order_date'];
        $status = $row['status'];
        $customer_name = $row['customer_name'];
        $customer_phone = $row['customer_phone'];
        $customer_address = $row['customer_address'];


        ?>
        <h3>Thông tin đơn hàng</h3>
        <form action="" method="POST">
            <table width=100%>
                <tr>
                    <th>Tên món ăn</th>
                    <th>Quantity</th>
                    <th>Unit price</th>
                    <th>Total</th>
                </tr>
                <?php
                $sql2 = "SELECT * FROM order_food WHERE id_order = '$id'";
                $res2 = mysqli_query($conn, $sql2);
                $cartTotal = 0;
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $total = 0;
                    $qty = $row2['qty'];
                    $id_food = $row2['id_food'];
                    $sql3 = "SELECT * FROM tbl_food WHERE id = '$id_food'";
                    $res3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_assoc($res3);
                    $total = number_format($total + $row3['price'] * $qty, 2);
                    $cartTotal = number_format($cartTotal + $row3['price'] * $qty, 2);

                ?>
                    <tr>
                        <td><?= $row3['title'] ?></td>
                        <td><?= $qty ?> </td>
                        <td>$<?= $row3['price'] ?></td>
                        <td>$<?= $total ?></td>
                    </tr>
                <?php

                }
                ?>


            </table>
            <div class="row-order" style="margin: 10px 0;">
                <p style="display: inline-block; min-width: 100px;">Total Order: </p>
                <input type="text" value="$<?= $cartTotal ?>" disabled>
            </div>
            <div class="row-order" style="margin: 10px 0;">
                <p style="display: inline-block; min-width: 100px;">FullName: </p>
                <input type="text" value="<?= $customer_name ?>" name="fullname">
            </div>
            <div class="row-order" style="margin: 10px 0;">
                <p style="display: inline-block; min-width: 100px;">Phone: </p>
                <input type="text" value="<?= $customer_phone ?>" name="phone">
            </div>
            <div class="row-order" style="margin: 10px 0;">
                <p style="display: inline-block; min-width: 100px;">Address: </p>
                <input type="text" value="<?= $customer_address ?>" name="address">
            </div>
            <div class="row-order" style="margin: 10px 0;">
                <p style="display: inline-block; min-width: 100px;">Trạng thái: </p>
                <select name="status">
                    <option value="0" <?= $status == "0" ? 'selected' : '' ?>>No process</option>
                    <option value="1" <?= $status == "1" ? 'selected' : '' ?>>Processing</option>
                    <option value="2" <?= $status == "2" ? 'selected' : '' ?>>Delivered</option>
                </select>
                <input type="submit" name="submit" value="Change">
            </div>
            <?php

            ?>
        </form>

    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $status = $_POST['status'];
    // $id = $_POST['id'];
    $sql = "UPDATE `tbl_order` SET `status` = '$status' WHERE `tbl_order`.`id` = $id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['update-order'] = "<div class='success'>Đơn hàng đã được chỉnh sửa</div>";
        header("location: manage-order.php");
    } else {
        $_SESSION['update-order'] = "<div class='error'>Lỗi khi chỉnh sửa đơn hàng</div>";
        header("location: manage-order.php");
    }
}
include('partials/footer.php');
?>