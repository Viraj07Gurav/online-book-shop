<?php
//admin_books.php
function getAll($conn) {
    $query="SELECT * FROM books ORDER BY book_isbn DESC";
    $result=mysqli_query($conn,$query);
    if(!$result) {
        echo "failed".mysqli_error($conn);
    }
    return $result;
}

//admin_add.php
	function getPubName($conn, $pubid){
		$query = "SELECT publisher_name FROM publisher WHERE publisherid = '$pubid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Empty books ! Something wrong! check again";
			exit;
		}

		$row = mysqli_fetch_assoc($result);
		return $row['publisher_name'];
	}
?>