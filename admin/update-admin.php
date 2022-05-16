
 <?php include ('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>


        <?php
            //get id
            $id = $_GET['id']; // get id tu url
            $sql  = "SELECT * FROM tbl_user WHERE id = $id";
            $res = mysqli_query($conn,$sql);
            
            if ($res == true){
                $count = mysqli_num_rows(mysqli_query($conn,$sql));
                if ($count == 1){
                    $row = mysqli_fetch_assoc(mysqli_query($conn,$sql));
                    
                    $full_name = $row['full_name'];
                    $phone = $row['phone'];
                    $email = $row['email'];
                }else{
                    header('location:manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tlb-30 ">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?= $full_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Phone: 
                    </td>
                    <td>
                        <input type="text" name="phone" value="<?= $phone ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Email: 
                    </td>
                    <td>
                        <input type="text" name="email" value="<?= $email ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?=$id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    //check submit 
    if (isset($_POST['submit'])){
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $sql = "UPDATE tbl_user SET
            full_name = '$full_name',
            phone = '$phone',
            email = '$email'
            WHERE id ='$id'
        ";
        $res = mysqli_query($conn, $sql);
        if ($res == true){
            $_SESSION['update'] = "<div class='success'> Admin Update Successfully.</div>";
            header("location: manage-admin.php");
        }else{
            $_SESSION['update'] = "<div class='error'>Fail to Delete Admin.</div>";
            header("location: manage-admin.php");
        }

    }
?>

 <?php include ('partials/footer.php'); ?>

