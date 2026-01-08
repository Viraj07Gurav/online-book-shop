<?php
session_start();
$title = "Book";
require("./functions/database_function.php");
require("./config/db.php");
$conn = db_connect();

$book_isbn = $_GET['bookisbn'];

$book = getBookByIsbn1($conn, $book_isbn);

if(!$book){
    die("Book not found");
}

$title = $book['book_title'];

require "./template/header.php";
?>

<p class="lead" style="margin: 25px 0">
  <a href="books.php">Books</a> > 
  <?php echo $book['book_title']; ?>
</p>

<div class="row">
  <div class="col-md-3 text-center">
    <img class="img-responsive img-thumbnail" 
         src="./uploads/<?php echo $book['book_image']; ?>">
  </div>

  <div class="col-md-6">
    <h4>Book Description</h4>
    <p><?php echo $book['book_descr']; ?></p>

    <h4>Book Details</h4>

    <table class="table">
      <tr>
        <td>ISBN</td>
        <td><?php echo $book['book_isbn']; ?></td>
      </tr>

      <tr>
        <td>Author</td>
        <td><?php echo $book['book_author']; ?></td>
      </tr>

      <tr>
        <td>Price</td>
        <td><?php echo $book['book_price']; ?></td>
      </tr>
    </table>

    <form method="post" action="cart.php">
      <input type="hidden" name="bookisbn" value="<?php echo $book_isbn; ?>">
      <input type="submit" value="Purchase / Add to cart" name="cart" class="btn btn-primary">
    </form>
  </div>
</div>

<?php
mysqli_close($conn);
 require "template/footer.php";
?>
