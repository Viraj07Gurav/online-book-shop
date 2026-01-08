<?php
session_start();
require("../functions/admin.php");
require("../functions/database_function.php");
require_once("../config/db.php");
$conn = db_connect();
require_once('../template/header.php');

if (isset($_POST['add'])) {
    $isbn = trim($_POST['isbn']);
    $isbn = mysqli_real_escape_string($conn, $isbn);
    $title = trim($_POST['title']);
    $title = mysqli_real_escape_string($conn, $title);
    $author = trim($_POST['author']);
    $author = mysqli_real_escape_string($conn, $author);
    $descr = trim($_POST['descr']);
    $descr = mysqli_real_escape_string($conn, $descr);
    $price = trim($_POST['price']);
    $price = mysqli_real_escape_string($conn, $price);
    $publisher = trim($_POST['publisher']);
    $publisher = mysqli_real_escape_string($conn, $publisher);

    $target_dir = '../uploads/';
    $target_file = $target_dir . basename($_FILES['file']['name']);
    $check = getimagesize($_FILES['file']['tmp_name']);
    if ($check !== false) {
        echo 'Valid image' . $check['mime'];
    } else {
        echo 'Invalid image';
    }
    $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($ext, $allowed)) {
        die('not supported');
    }
    $newname = uniqid(time() . '.' . $ext);
    $newimage = $target_dir . $newname;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $newimage)) {
        $image = $newname;
        echo 'file uploaded';

    } else {
        echo 'uploads failed';

    }

    // find publisher 
    // find publisher 
    $findpublisher = "SELECT * FROM publisher WHERE publisher_name='$publisher'";
    $result = mysqli_query($conn, $findpublisher);

    if (mysqli_num_rows($result) == 0) {

        // insert if not exists
        $insertpublisher = "INSERT INTO publisher(publisher_name) VALUES('$publisher')";
        $insertResult = mysqli_query($conn, $insertpublisher);

        if (!$insertResult) {
            echo "Can't add new publisher " . mysqli_error($conn);
            exit;
        }

        $publisherid = mysqli_insert_id($conn);

    } else {

        $row = mysqli_fetch_assoc($result);
        $publisherid = $row["publisherid"];
    }


    $query = "INSERT INTO books VALUES ('$isbn','$title','$author','$image','$descr','$price','$publisherid')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Can't add new data " . mysqli_error($conn);
        exit;
    } else {
        header("Location: admin_book.php");
    }
}
?>

<form method="post" action="admin_add.php" enctype="multipart/form-data">
    <table class="table">
        <tr>
            <th>ISBN</th>
            <td><input type="text" name="isbn"></td>
        </tr>
        <tr>
            <th>Title</th>
            <td><input type="text" name="title"></td>
        </tr>
        <tr>
            <th>Author</th>
            <td><input type="text" name="author" required></td>
        </tr>
        <tr>
            <th>Image</th>
            <td><input type="file" name="file"></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><textarea name="descr" cols="40" rows="5"></textarea></td>
        </tr>
        <tr>
            <th>Price</th>
            <td><input type="text" name="price" required></td>
        </tr>
        <tr>
            <th>Publisher</th>
            <td><input type="text" name="publisher" required></td>
        </tr>
    </table>
    <input type="submit" name="add" value="Add new book" class="btn btn-primary">
    <a href="admin_book.php"><input type="reset" value="cancel" class="btn btn-secondary"></a>
</form>
<?php
if ($conn) {
    mysqli_close($conn);
}
?>