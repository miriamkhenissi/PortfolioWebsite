<?php $title = "Portfolio"; ?>
<?php require("header.php"); ?>


<?php
$list = [];
$sql = "
    SELECT * FROM ( 
        SELECT DISTINCT idGallery FROM gallery AS G 
        INNER JOIN meta AS M ON M.picture_id = G.idGallery 
        AND M.meta_key = 'visibility' 
        AND M.meta_value != 1 OR M.meta_value = 1 
        AND G.userGallery = ".$current_user->ID." 
        LIMIT 50 
    ) AS ID 
    INNER JOIN gallery AS G ON G.idGallery = ID.idGallery 
    INNER JOIN meta AS M ON M.picture_id = G.idGallery 
    AND M.meta_key = 'visibility' ORDER BY orderGallery DESC
";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed!";
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }

}
?>
<main>
    <div class="wrapper">
        <div class="container">
            <h2>Gallery</h2>
            <div class="main-gallery">
                <div class="cols-row">
                <?php foreach ($list as $item) { ?>
                    <div class="column">
                        <div class="item">
                            <a href="#">
                                <div class="picture" style="background-image:url(img/gallery/<?= $item["imgFullNameGallery"]; ?>);">
                                    <?= $item["meta_value"] == '1' ? '<div class="lock"></div>' : '' ?>
                                </div>
                                <div class="content">
                                    <h3 class="title"><?= $item["titleGallery"] ?></h3>
                                    <p class="desc"><?= $item["descGallery"] ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
            <?php if($is_logged_in){ ?>
            <div class="gallery-upload">
                <h4>Upload an image</h4>
                <form action="includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                            <legend>Personalia:</legend>
                    <div class="field">    <label for="peas">Do you like peas?</label>
<input type="text" name="filename" placeholder="File name..." /></div>
                    <div class="field">    <label for="peas">Do you like peas?</label>
<input type="text" name="filetitle" placeholder="Image title..." /></div>
                    <div class="field">    <label for="peas">Do you like peas?</label>
<textarea name="filedesc" placeholder="Image description..."></textarea></div>
                    <div class="visibility-option">
                        <label>Private     <label for="peas">Do you like peas?</label>
<input type="radio" name="visibility" value="1" checked /></label>
                        <span> | </span>
                        <label>Public     <label for="peas">Do you like peas?</label>
<input type="radio" name="visibility" value="0" /></label>
                    </div>
                    <div class="field">    <label for="peas">Do you like peas?</label>
<input type="file" name="file"/></div>                            
                    <button  type="submit" name="submit">Upload</button>
                    </fieldset>
                </form>
            </div>
            <?php } ?>            
        </div>
    </div>
</main>
<?php require("footer.php"); ?>