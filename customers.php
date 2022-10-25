<div class="section">
<form action="model/customers.php" method="post">
    <div class="container">
        <label for="name" ><b>Name</b>:</label>
        <input type="text" name="name" placeholder="Enter customer Name"   required /> <br>

    </div>
    <div class="container">
        <label for="Email"><b>Email:</b></label>
        <input type="email" name="email" placeholder="Enter customer Email"  required/> <br>
    </div>

    <div class="container">
        <label for="username"><b>User Name:</b></label>
        <input type="text" name="username" placeholder="Enter customer UserName"  required/> <br>
    </div>
    <div class="container">
        <label for="city"><b>city:</b></label>
        <input type="text" id="city" name="city" placeholder="Enter city name"  required/> <br>
    </div>
    <div class="container">
        <label for="country"><b>Country:</b></label>
        <input  type="text" id="country" name="country"  placeholder="Confirm country name"  /> <br>
        <span id="message">  </span>
    </div>
    <div class="container">
        <label for="state"><b>State:</b></label>
        <input  type="text" id="state" name="state"  placeholder="enter your state name"   /> <br>
    </div>

    <div class="container">
        <label for="state"><b>Zipcode:</b></label>
        <input  type="text" id="zipcode" name="zipcode"  placeholder="enter the zip code" /> <br>
    </div>
    <div class="container">
        <label for="state"><b>Customer Group:</b></label>
        <input  type="text"  name="customers_group"  placeholder=" enter customers group"  /> <br>
    </div>

    <div class="container">
        <label for="Mobile"><b>Mobile:</b></label>
        <input type="text" name="mobile" placeholder="Enter your Mobile Number"  required/> <br>
    </div>
    <div class="container">
        <label for="Status"><b>Status:</b></label>
        <select name="status">
            <option value="1">Active</option>
            <option value="2">Not Active</option>
            <select>

    </div><br>


    <diV>
        <input type="submit" value="Save" name="save"  style="width:20px height:20px">

    </div>
    </form>
</div>
