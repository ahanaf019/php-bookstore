<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Query Book:</h2>
    <form action="searchBook.php" method="post">
        <table>
            <tr>
                <td>
                    <select name="field" id="field">
                        <option value="title">Title</option>
                        <option value="author">Author</option>
                        <option value="year">Year</option>
                        <option value="isbn">ISBN</option>
                        <option value="pages">Pages</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="value">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Search">
                </td>
            </tr>
        </table>
    </form>

    <?php 

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        // echo "<button onclick=\"redirectMain()\">Go Back</button>";

        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $json = file_get_contents('book_list.json');
        $books = json_decode($json, true);

        $searchField = $_POST['field'];
        $searchTerm = $_POST['value'];
        $matching = [];

        foreach ($books as $book) 
        {
            if (strpos(strtolower($book[$searchField]), $searchTerm) !== false) {
                $matching[] = $book;
            }
        }

        // echo "<pre>";
        // var_dump($matching);
        // echo "</pre>";
    }
    
    ?>

<h2>Results:</h2>

    <?php 
    echo "<p>Found ".count($matching)." books with \"".ucfirst($searchField)."\" as \"".$searchTerm."\"</p>";
    ?>

    <table border="1">
        <caption>Books</caption>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>ISBN</th>
            <th>Pages</th>
        </tr>

        
            <?php 
            for($i = 0; $i < count($matching); $i++){
                echo '<tr>';
                foreach($matching[$i] as $key => $value)
                {
                echo "<td>".$matching[$i][$key]."</td>";
                }
                echo '</tr>';
            }
            ?>
        
    </table>
    <button onclick="redirectMain()">Go Back</button>


    <script>
        function redirectMain() {
            window.location.href = "books.php";
        }
    </script>

</body>
</html>