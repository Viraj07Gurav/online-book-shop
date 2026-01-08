<?php
session_start();
require_once "./functions/database_function.php";
require "./template/header.php";

$title = "Checking out";
require_once('config/db.php');
$conn = db_connect();

// Check if cart has items
if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){

    // Calculate totals
    $total_items = 0;
    $total_price = 0.0;
    $cart_books = [];

    foreach($_SESSION['cart'] as $isbn => $qty){
        $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
        if($book !== false){
            $book['qty'] = $qty;
            $book['total'] = $book['qty'] * $book['book_price'];
            $total_items += $qty;
            $total_price += $book['total'];
            $cart_books[] = $book;
        }
    }
?>

<h3>Checkout</h3>

<table class="table">
    <tr>
        <th>Item</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>
    <?php foreach($cart_books as $book): ?>
    <tr>
        <td><?php echo htmlspecialchars($book['book_title'] . " by " . $book['book_author']); ?></td>
        <td><?php echo "$" . $book['book_price']; ?></td>
        <td><?php echo $book['qty']; ?></td>
        <td><?php echo "$" . $book['total']; ?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <th colspan="2">&nbsp;</th>
        <th><?php echo $total_items; ?></th>
        <th><?php echo "$" . $total_price; ?></th>
    </tr>
</table>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <form method="post" action="purchase.php">

                <?php if(isset($_SESSION['err']) && $_SESSION['err'] == 1){ ?>
                    <p class="text-danger">All fields have to be filled</p>
                <?php } ?>

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control">
                </div>

                <div class="mb-3">
                    <label>City</label>
                    <input type="text" name="city" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Zip Code</label>
                    <input type="text" name="zip_code" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Country</label>
                    <input type="text" name="country" class="form-control">
                </div>

                <button type="submit" name="submit" class="btn btn-primary">
                    Continue to Payment
                </button>

            </form>

        </div>
    </div>
</div>

	<p class="lead">Please press Purchase to confirm your purchase, or Continue Shopping to add or remove items.</p>
<?php
	} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
	// require_once "./template/footer.php";
?>