<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
    {
        echo "<h1>Wrong Method GET</h1>";
        exit('');
    }
    
    echo '<pre>';
    $updateIdx = $_POST['update'];
    $json = file_get_contents('book_list.json');
    $book = json_decode($json, true);
    $book = $book[$updateIdx];
    // var_dump($_POST);
    // var_dump($book);
    echo '</pre>';

    ?>

    <form action="books.php" method="post">
        <table>
            <caption>Add new book information.</caption>
            <tr>
                <td>Title</td>
                <td>
                <?php echo "<input type=\"text\" name=\"title\" value=$book[title] required>"; ?>
                </td>
            </tr>

            <tr>
                <td>Author</td>
                <td>
                <?php echo "<input type=\"text\" name=\"author\" value=$book[author] required>"; ?>
                </td>
            </tr>

            <tr>
                <td>Year</td>
                <td>
                    <?php echo "<input type=\"number\" name=\"year\" value=$book[year] required>"; ?>
                </td>
            </tr>

            <tr>
                <td>ISBN</td>
                <td>
                <?php echo "<input type=\"number\" name=\"isbn\" value=$book[isbn] required>"; ?>
                </td>
            </tr>

            <tr>
                <td>Pages</td>
                <td>
                <?php echo "<input type=\"number\" name=\"pages\" value=$book[pages] required>"; ?>
                </td>
            </tr>
            <tr>
                <td>
                <?php echo "<input name=\"updateIdx\" type=\"hidden\" value=$updateIdx>"; ?>
                </td>
                <td>
                    <button type="submit">Submit</button>
                </td>
            </tr>
        </table>
    </form>

    <button onclick="redirectMain()">Go Back</button>


    <script>
        function redirectMain() {
            window.location.href = "books.php";
        }
    </script>

</body>
</html>