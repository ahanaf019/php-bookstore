<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
    // echo '<pre>';
    // var_dump($_SERVER['HTTP_REFERER']);
    // echo '</pre>'; 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $referer = $_SERVER['HTTP_REFERER'];
        $referer = explode("/", $referer);
        $referer = $referer[count($referer) -1];
        // echo '<pre>';
        // var_dump($referer);
        // var_dump($_POST);
        // echo '</pre>';

        $json = file_get_contents('book_list.json');
        $books = json_decode($json, true);

        if($referer == "addBook.php")
        {
            $newBook = [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'year' => $_POST['year'],
                'isbn' => $_POST['isbn'],
                'pages' => $_POST['pages'],
            ];
    
            
            $books[] = $newBook;
            $jsonString = json_encode($books, $JSON_PRETTY_PRINT);
            file_put_contents('book_list.json', $jsonString);
            
        }

        else if($referer == 'books.php')
        {
            $unsetIdx = $_POST['delete'];
            unset($books[$unsetIdx]);
            $books = array_values($books);
            $jsonString = json_encode($books, $JSON_PRETTY_PRINT);
            file_put_contents('book_list.json', $jsonString);
        }

        else if($referer == 'updateBook.php')
        {
            $updatedBook = [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'year' => $_POST['year'],
                'isbn' => $_POST['isbn'],
                'pages' => $_POST['pages'],
            ];
            
            $books[$_POST['updateIdx']] = $updatedBook;
            $jsonString = json_encode($books, $JSON_PRETTY_PRINT);
            file_put_contents('book_list.json', $jsonString);
        }

    }
    ?>

    <?php 
    $json = file_get_contents('book_list.json');
    $books = json_decode($json, true);
    // echo '<pre>';
    // var_dump($books);
    // echo '</pre>';
    ?>

    <button onclick="redirectToAddBook()">Add New Book</button>
    <button onclick="redirectToSearchBook()">Search Book</button>

    <table border="1">
        <caption>Books Database</caption>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>ISBN</th>
            <th>Pages</th>
            <th colspan="2">Action</th>
        </tr>

        
            <?php 
            for($i = 0; $i < count($books); $i++){
                echo '<tr>';
                foreach($books[$i] as $key => $value)
                {
                echo "<td>".$books[$i][$key]."</td>";
                }
                echo "<td><form action=\"updateBook.php\" method=\"post\"><button name=\"update\" value=$i>Update</button></td></form>";
                echo "<td><form action=\"\" method=\"post\"><button name=\"delete\" value=$i>Delete</button></td></form>";
                echo '</tr>';
            }
            ?>
        
    </table>

    <script>
        function redirectToAddBook() {
            window.location.href = "addBook.php";
        }
        function redirectToSearchBook() {
            window.location.href = "searchBook.php";
        }
    </script>

</body>
</html>