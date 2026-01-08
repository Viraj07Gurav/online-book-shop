<?php
session_start();
require_once('../template/header.php');
require('../config/db.php');
require('../functions/admin.php');
$conn = db_connect();
$all_books = getAll($conn);
$title = "book list";

?>
<div class="row justify-content-left mt-2 px-5">
    <div class="col-md-6"><a href="admin_add.php" class="btn btn-primary">Add Book</a></div>

</div>
<hr>
<table class="table">
    <tr>
        <th>ISBN</th>
        <th>TITLE</th>
        <th>AUTHOR</th>
        <th>IMAGE</th>
        <th>DESCREPTION</th>
        <th>PUBLISHER</th>
        <th>PRICE</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($all_books)) { ?>
        <tr>
            <td><?php echo $row['book_isbn']; ?></td>
            <td><?php echo $row['book_title']; ?></td>
            <td><?php echo $row['book_author']; ?></td>
            <td><?php echo $row['book_image']; ?></td>
            <td><?php echo $row['book_descr']; ?></td>
<td><?php echo getPubName($conn, $row['publisherid']); ?></td>
            <th><?php echo $row['book_price']; ?></th>
            
			<td><a href="admin_edit.php?bookisbn=<?php echo $row['book_isbn']; ?>">Edit</a></td>
			<td><a href="admin_delete.php?bookisbn=<?php echo $row['book_isbn']; ?>">Delete</a></td>
        </tr>

    <?php } ?>
</table>