<?php
session_start();
$title = "Book List";
$count = 0;
require("./functions/database_function.php");
require_once("./config/db.php");
$conn=db_connect();
$books=getAllBooks($conn);

if(!$books){
    die('books not found');

}

include('./template/header.php');

?>
<p>Full Catalogs of Books</p>
<?php for($i=0;$i<mysqli_num_rows($books);$i++){ ?>
    <div class="row">
        <?php while($row=mysqli_fetch_assoc($books)){ ?>
             <div class="col-md-3">
            <a href="book.php?bookisbn=<?php echo $row['book_isbn']; ?>">
              <img class="img-responsive img-thumbnail" src="./uploads/<?php echo $row['book_image']; ?>">
            </a>
          </div>
          <?php
          $count++;
          if($count >= 4){
            $count=0;
            break;
          }
        }?>
    </div>

<?php }?>
<?php
if($conn){
  mysqli_close($conn);
}
include('template/footer.php');
?>

