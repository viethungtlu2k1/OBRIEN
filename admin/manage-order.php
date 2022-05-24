<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <?php
        if (isset($_SESSION['update-order'])) {
            echo $_SESSION['update-order'];
            unset($_SESSION['update-order']);
        }

        ?>
        <form action="" method="POST">
            <select name="option_order">
                <?php
                $select = 0;
                if (isset($_SESSION['select'])) {
                    $select = $_SESSION['select'];
                    unset($_SESSION['select']);
                }
                ?>
                <option value="0" <?= $select == "0" ? 'selected' : '' ?>>Chưa xử lí</option>
                <option value="1" <?= $select == "1" ? 'selected' : '' ?>>Đang xử lí</option>
                <option value="2" <?= $select == "2" ? 'selected' : '' ?>>Đã giao</option>
                <?php
                ?>
            </select>
            <button type="submit">Tìm</button>
        </form>

        <?php
        if (isset($_POST["option_order"])) {
            $_SESSION['select'] = $_POST["option_order"];
            header("location: manage-order.php");
        }
        ?>

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Chi tiết đơn hàng</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_order WHERE status = '$select'";
            $res = mysqli_query($conn, $sql);
            $sn = 1;
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    // $qty = $row['qty'];
                    // $price = $row['price'];
                    // $tongtien = (int)$qty * $price;

            ?>
                    <tr>
                        <td><?= $id ?> </td>
                        <td>
                            <a href="edit-order.php?id=<?= $id ?>" class="btn-secondary">Chi tiết</a>
                        </td>
                    </tr>
            <?php
                }
            }

            ?>


        </table>

    </div>
</div>


<?php include('partials/footer.php') ?>