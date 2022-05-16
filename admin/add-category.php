<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Add Category</h1>
    <!--manage-category.php-->
    <?php
        
        if (isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
    
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
            <table class="tlb-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">  Yes
                        <input type="radio" name="active" value="No" >  No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php
    if (isset($_POST['submit'])){
        // lay data tu form
        $title = $_POST['title'];
        
        if (isset($_POST['active'])){
            if ($_POST['active'] === 'Yes'){
                $active = 'Yes';
            }
            else{
                $active = 'No';
            }
        }
        // add to sql
        $sql = "INSERT INTO `tbl_category`(`id`, `title`, `active`) 
        VALUES (NuLL,'$title','$active')";
        
        $res = mysqli_query($conn, $sql);

        if ($res == true){
            $_SESSION['add'] = "<div class='success'> Category Added Successfully</div>";
            header("location: manage-category.php");
        }else{
            $_SESSION['add'] = "<div class='error'> Failed to Add Category</div>";
            header("location: manage-category.php");
        }
    }

?>


 <?php include ('partials/footer.php'); ?>