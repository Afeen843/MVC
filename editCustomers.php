<?php
include_once('config.php');
$id = $_GET['id'] ?? '';

?>
<div class="section">
    <form action="model/editCustomers.php" method="post" enctype="multipart/form-data">

        <div class="container">
            <label for="name"><b>Name</b>:</label>
            <input type="text" name="name" value=''>
        </div>
        <div class="container">
            <label for="Email"><b>Email:</b></label>
            <input type="email" name="email" value="">
        </div>

        <div class="container">
            <label for="city"><b>City:</b></label>
            <input type="text" name="city" value=''>
        </div>


        <div class="container">
            <label><b>Country:</b></label>
            <input type="text" name="country" value=''>
        </div>

        <div class="container">
            <label><b>State:</b></label>
            <input type="text" name="state" value=''>
        </div>

        <div class="container">
            <label><b>Zip code:</b></label>
            <input type="text" name="zipcode" value=''>
        </div>

        <div class="container">
            <label><b>Created at:</b></label>
            <input type="text" name="created_at" value=''>
        </div>
        <div class="container">
            <label><b>modified at:</b></label>
            <input type="text" id="pwd" name="modified_at" value=''>
        </div>


        <div class="container">
            <label for="Status"><b>Status:</b></label>
            <select name="status" value=''>
                <option value="1">Active</option>
                <option value="2">Not Active</option>
                <select>
        </div>

        <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>

        <diV>
            <input type="submit" value="update" name="update" style="width:20px height:20px">
        </div>
    </form>
</div>


