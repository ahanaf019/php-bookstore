<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>



    <form action="books.php" method="post">
        <table>
            <caption>Add new book information.</caption>
            <tr>
                <td>Title</td>
                <td>
                    <input type="text" name="title" required>
                </td>
            </tr>

            <tr>
                <td>Author</td>
                <td>
                    <input type="text" name="author" required>
                </td>
            </tr>

            <tr>
                <td>Year</td>
                <td>
                    <input type="number" name="year" required>
                </td>
            </tr>

            <tr>
                <td>ISBN</td>
                <td>
                    <input type="number" name="isbn" required>
                </td>
            </tr>

            <tr>
                <td>Pages</td>
                <td>
                    <input type="number" name="pages" required>
                </td>
            </tr>
            <tr>
                <td></td>
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