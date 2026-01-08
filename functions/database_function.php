<?php
// index.php
function select4LatestBooks($conn){
    $books=array();
    $query="SELECT book_isbn,book_image FROM books ORDER BY book_isbn DESC LIMIT 4";
    $result=mysqli_query($conn,$query);
    if(!$result){
        echo "failed fetch data".mysqli_error($conn);
        exit;

    }
    while($row=mysqli_fetch_assoc($result)){
        array_push($books,$row);
    }
    return $books;

}

function getPublisher($conn){
    

}

// get books.php
function getAllBooks($conn){
    $query="SELECT book_isbn,book_image FROM books";
    $result=mysqli_query($conn,$query);
    if(!$result){
        die("query failed".mysqli_error($conn));
    }
    return $result;

}
/// book.php
	function getBookByIsbn1($conn, $isbn){
    $isbn = mysqli_real_escape_string($conn, $isbn);

    $sql = "SELECT * FROM books WHERE book_isbn = '$isbn'";
    $result = mysqli_query($conn, $sql);

    if(!$result){
        die("Query failed: " . mysqli_error($conn));
    }

    return mysqli_fetch_assoc($result);
	
}

function getBookByIsbn($conn, $isbn){
    $isbn = mysqli_real_escape_string($conn, $isbn);
    $query = "SELECT book_title, book_author, book_price FROM books WHERE book_isbn='$isbn' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Query error: " . mysqli_error($conn);
        return false;
    }

    // $row = mysqli_fetch_assoc($result);

    // if ($row) {
    //     return $row; // associative array
    // } else {
    //     return false; // ISBN not found
    // }
    return $result;
}


//cart function.php
function getbookprice($isbn, $conn){
    $isbn = mysqli_real_escape_string($conn, $isbn);
    $query = "SELECT book_price FROM books WHERE book_isbn='$isbn' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Query error: " . mysqli_error($conn);
        return false;
    }

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        return $row['book_price'];
    } else {
        // ISBN not found
        return false;
    }
}



?>