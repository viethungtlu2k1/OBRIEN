<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Account</h1>

        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        if (isset($_SESSION['pwd-not-math'])) {
            echo $_SESSION['pwd-not-math'];
            unset($_SESSION['pwd-not-math']);
        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }


        ?>
        <br><br>
        <!-- button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add employee account</a>
        <br />
        <br>

        <h3>Account empleyee</h3>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Fullname</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_user where level = 1";

            $result = mysqli_query($conn, $sql);
            $sn = 1;
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $full_name = $row['full_name'];
                    $phone = $row['phone'];
            ?>
                    <tr>
                        <td><?= $sn++ ?> </td>
                        <td><?= $full_name ?></td>
                        <td><?= $phone ?></td>
                        <td>
                            <a href="update-password.php?id= <?php echo $id ?>" class="btn-primary">Change Pasword</a>
                            <a href="update-admin.php?id= <?php echo $id ?>" class="btn-secondary">Update Admin</a>
                            <a href="delete-admin.php?id= <?php echo $id ?>" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

            <?php


                }
            }

            ?>

        </table>
        <br>

        <h3>Account custumer</h3>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Fullname</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_user where level =0";

            $result = mysqli_query($conn, $sql);
            $sn = 1;
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $full_name = $row['full_name'];
                    $phone = $row['phone'];
            ?>
                    <tr>
                        <td><?= $sn++ ?> </td>
                        <td><?= $full_name ?></td>
                        <td><?= $phone ?></td>
                        <td>
                            <a href="update-password.php?id= <?php echo $id ?>" class="btn-primary">Change Pasword</a>
                            <a href="update-admin.php?id= <?php echo $id ?>" class="btn-secondary">Update Admin</a>
                            <a href="delete-admin.php?id= <?php echo $id ?>" class="btn-danger">Delete Admin</a>
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