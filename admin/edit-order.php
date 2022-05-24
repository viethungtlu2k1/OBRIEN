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
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng</th>
                </tr>
                <?php
                $sql2 = "SELECT * FROM order_food WHERE id_order = '$id'";
                $res2 = mysqli_query($conn, $sql2);
                $total = 0;
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $qty = $row2['qty'];
                    $id_food = $row2['id_food'];
                    $sql3 = "SELECT * FROM tbl_food WHERE id = '$id_food'";
                    $res3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_assoc($res3);
                    $total = number_format($total + $row3['price'] * $qty, 2);

                ?>
                    <tr>
                        <td><?= $row3['title'] ?></td>
                        <td><?= $qty ?> </td>
                        <td><?= $row3['price'] ?></td>
                        <td><?= $total ?></td>
                    </tr>
                <?php

                }
                ?>


            </table>
        </form>
        <div class="row-order" style="margin: 10px 0;">
            <p style="display: inline-block; min-width: 100px;">Tổng tiền: </p>
            <input type="text" value="Thay đổi" disabled>
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
                <option value="Chưa xử lí" <?= $status == "Chưa xử lí" ? 'selected' : '' ?>>Chưa xử lí</option>
                <option value="Đang xử lí" <?= $status == "Đang xử lí" ? 'selected' : '' ?>>Đang xử lí</option>
                <option value="Đã giao" <?= $status == "Đã giao" ? 'selected' : '' ?>>Đã giao</option>
            </select>
            <input type="submit" name="submit" value="Thay đổi">
        </div>
        <?php

        ?>

    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $status = $_POST['status'];
    $id = $_POST['id'];
    $sql = "UPDATE `tb_order` SET `status` = '$status' WHERE `tb_order`.`id` = $id";


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