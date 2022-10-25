<html>

<head>
    <title> Categories</title>
</head>
<body><br>

<div class="section">
    <form action="model/categories.php" method="post" enctype="multipart/form-data">


        <label for="picture">Picture:</label><br>
        <input type="file" name="image" accept="image/png"/><br>

        <label for="categories_id">Categories:</label><br>
        <input type="text" name="categories_id" placeholder="Enter Categories Id"><br>

        <label for="picture"> Name: </label><br>
        <input type="text" name="name" placeholder="Enter categories name"/><br><br>

        <input type="submit" name="submit"/>

    </form>
</div>


</body>
</html>



