<?php
session_start();
require_once('./config/db.php');
require_once('./functions/database_function.php');
require('./template/header.php');
require('./functions/cart_function.php');
$title = "Your shopping cart";
$conn=db_connect();
if(isset($_POST['bookisbn'])){
    $book_isbn = $_POST['bookisbn'];
}
// unset($_SESSION['cart']);
// $_SESSION['total_items'] = 0;
// $_SESSION['total_price'] = 0.00;
if(isset($book_isbn)){
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] =[];
    $_SESSION['total_item'] =0;
    $_SESSION['total_price'] = 0.00;
}
if(!isset( $_SESSION['cart'][$book_isbn])){
    $_SESSION['cart'][$book_isbn] = 1;
}elseif(isset($_POST['cart'])){
    $_SESSION['cart'][$book_isbn]++;
    unset($_POST);
}
}
// if save change button is clicked , change the qty of each bookisbn
	if(isset($_POST['save_change'])){
		foreach($_SESSION['cart'] as $isbn =>$qty){
			if($_POST[$isbn] == '0'){
				unset($_SESSION['cart'][$isbn]);
			} else {
				$_SESSION['cart'][$isbn] = $_POST[$isbn];
			}
		}
	}

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
	$_SESSION['total_price'] = total_price($_SESSION['cart'],$conn);
		$_SESSION['total_items'] = total_items($_SESSION['cart']);

?>
<h3 class="">My cart</h3>
<form action="cart.php" method="post">
    <table class="table">
      <tr>
        <th>Item</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
      </tr>
    <?php
		    	foreach($_SESSION['cart'] as $isbn => $qty){
					$conn = db_connect();
					$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
			<tr>
				<td><?php echo $book['book_title'] . " by " . $book['book_author']; ?></td>
				<td><?php echo "$" . $book['book_price']; ?></td>
				<td><input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>"></td>
				<td><?php echo "$" . $qty * $book['book_price']; ?></td>
			</tr>
			<?php } ?>
		    <tr>
		    	<th>&nbsp;</th>
		    	<th>&nbsp;</th>
		    	<th><?php echo $_SESSION['total_items']; ?></th>
		    	<th><?php echo "$" . $_SESSION['total_price']; ?></th>
		    </tr>
	   	</table>
	   	<input type="submit" class="btn btn-primary" name="save_change" value="Save Changes">
	</form>
	<br/><br/>
	<a href="checkout.php" class="btn btn-primary">Go To Checkout</a> 
	<a href="books.php" class="btn btn-primary">Continue Shopping</a>
<?php
		} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
	require_once "template/footer.php";
?>