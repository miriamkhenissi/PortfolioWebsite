<?php $title = "Account"; ?>
<?php require("header.php"); ?>

<?php
    $list = [];
    if($current_user->ID){
        $sql = "SELECT * from gallery WHERE userGallery=$current_user->ID";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)){
            while($row = mysqli_fetch_assoc($result)) {
                $list[]= $row;
            }
        }
    }
?>

    <main class="dashboard">
        <div class="container">
            <?php if($is_logged_in) { ?>
                <h3 class="login-status"> You are logged in! 🙌</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 3%">ID</th>
                                <th style="width: 54%">Image Title</th>
                                <th style="width: 13%">Image Order</th>
                                <th style="width: 30%">Image Details</th>
                            </tr>
                        </thead>
                        <?php foreach($list as $item){ ?>
                            <tr>
                                <td style="width: 3%"><?= $item["idGallery"]; ?></td>
                                <td style="width: 54%"><?= $item["titleGallery"]; ?></td>
                                <td style="width: 13%"><?= $item["orderGallery"]; ?></td>
                                <td style="width: 30%"><?= $item["descGallery"]; ?></td>
                            </tr>
                        <?php } ?>
                        <tfoot>
                            <tr>
                                <th style="width: 3%">ID</th>
                                <th style="width: 54%">Image Title</th>
                                <th style="width: 13%">Image Order</th>
                                <th style="width: 30%">Image Details</th>
                            </tr>
                        </tfoot>                        
                    </table>
                </div>
            <?php }else { ?>
                <h3 class="login-status"> You are not logged in! 🙄</h3>
            <?php } ?>
        </div>
    </main>


<?php require("footer.php"); ?>
