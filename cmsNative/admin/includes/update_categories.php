<?php
$category_id = $_GET["Edit"];
$query = " select * from category where category_id = {$category_id} ";
$select_mycategory = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_mycategory)) {
    $category_id    = escape($row["category_id"]);
    $category_title = escape($row["category_title"]);

?>
    <input value="<?php if (isset($category_title)) {
                        echo $category_title;
                    } ?>" class="form-control" type="text" name="category_title">
<?php } ?>