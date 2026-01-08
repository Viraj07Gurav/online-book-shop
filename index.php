<?php
session_start();
$title = "Index";
require('./config/db.php');
require_once('./functions/database_function.php');
$conn = db_connect();
$row = select4LatestBooks($conn);

if (!$row) {
  die('books not found');

}

include('template/header.php');

?>

<!-- Example row of columns -->
<p class="lead text-center text-muted">Latest books</p>

<div class="row justify-content-center">
    <?php foreach($row as $book){ ?>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3 text-center">
            <a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
                <img 
                    src="./uploads/<?php echo $book['book_image']; ?>" 
                    class="img-fluid img-thumbnail mx-auto d-block"
                >
            </a>
        </div>
    <?php } ?>
</div>
<?php
include('template/footer.php');
?>
