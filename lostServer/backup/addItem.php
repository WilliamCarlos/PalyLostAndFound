<?php
session_start();
include "utils.php";
echoHeadings();

if (!isset($_SESSION["user"])) { 
   echoTopImg("AddItem.jpg");
   echo "<h3><center>Please <a href='login.php'>login</a> to add any items</center></h3>";
   return;
}
?>

<title>Paly Lost and Found: Add Items</title>
  <?php echoTopImg("AddItem.jpg"); ?>
<div class="form">
  <form action= "action_page.php" method="post" enctype="multipart/form-data">
    <fieldset>
      <legend><span class="number">1</span> Item Description</legend>
      Type of Article: <select name="articleType">
	<option selected="selected" value="other">Other</option>
	<optgroup label="Please select an option below if possible: ">
	  <option value="shirt">Shirt</option>
	  <option value="pants">Pants</option>
	  <option value="jacket">Jacket</option>
	  <option value="backpack">Backpack</option>
	  <option value="binder">Binder</option>
	  <option value="cellphone">Cellphone</option>
	  <option value="watch">Watch</option>
	</optgroup>
      </select>
      Color of Article:  <select name="articleColor">
	<option selected="selected" value="other">Other</option>
	<octgroup label="Please select an option below if possible: ">
	  <option value="white">White</option>
	  <option value="black">Black</option>
	  <option value="yellow">Yellow</option>
	  <option value="green">Green</option>
	  <option value="blue">Blue</option>
	  <option value="purple">Purple</option>
	  <option value="grey">Grey</option>
	  <option value="brown">Brown</option>
	</octgroup>
      </select>
      Additional Details: <br> 
      <input type="text" name="additionalDetails" value="No additional details" onclick="this.value=''" 
	     onfocus="this.select()" onblur="this.value=!this.value?' No additional details ':this.value;" style="height: 75px"/>
      Upload an Image: <br>
      <input type="file" name="image"">
    </fieldset>
    <fieldset>
      <legend><span class="number">2</span> Owner's Info if known (optional)</legend>
      <input type="text" name="ownerFirstName" value="Owners First Name" onclick="this.value=''"
	     onfocus="this.select()" onblur="this.value=!this.value?' Unknown ':this.value;" />
      
      <input type="text" name="ownerLastName" value="Owners Last Name" onclick="this.value=''" 
	     onfocus="this.select()" onblur="this.value=!this.value?' Unknown ':this.value;" />
    </fieldset>
    <input type="submit" name="submit" value="Submit!"/>
</form>
</div>

<style type="text/css">
	.form{
		max-width: 550px;
		padding: 10px 20px;
		background: #f4f7f8;
		margin: 10px auto;
		padding: 20px;
		background: #f4f7f8;
		border-radius: 8px;
		font-family: Georgia, "Times New Roman", Times, serif;
	}
	.form fieldset{
		border: none;
	}
	.form legend {
		font-size: 1.4em;
		margin-bottom: 10px;
		background-color: #f4f7f8;;
	}
	.form label {
		display: block;
		margin-bottom: 8px;
	}
	.form input[type="text"],
	.form input[type="date"],
	.form input[type="datetime"],
	.form input[type="email"],
	.form input[type="number"],
	.form input[type="search"],
	.form input[type="time"],
	.form input[type="url"],
	.form input[type="password"],
	.form textarea,
	.form select {
		font-family: Georgia, "Times New Roman", Times, serif;
		#background: rgba(255,255,255,.1);
                background: rgba(255,255,255,.1);
		border: none;
		border-radius: 4px;
		font-size: 16px;
		margin: 0;
		outline: 0;
		padding: 7px;
		width: 100%;
		box-sizing: border-box; 
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box; 
		background-color: #e8eeef;
		color:#8a97a0;
		-webkit-box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
		box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
		margin-bottom: 30px;
	}
	.form input[type="text"]:focus,
	.form input[type="date"]:focus,
	.form input[type="datetime"]:focus,
	.form input[type="email"]:focus,
	.form input[type="number"]:focus,
	.form input[type="search"]:focus,
	.form input[type="time"]:focus,
	.form input[type="url"]:focus,
	.form textarea:focus,
	.form select:focus{
		background: #d2d9dd;
	}
	.form select{
		-webkit-appearance: menulist-button;
		height: 35px;
	}
	/*number at side of form*/
	.form .number {
		background: #1abc9c;
		color: #fff;
		height: 30px;
		width: 30px;
		display: inline-block;
		font-size: 0.8em;
		margin-right: 4px;
		line-height: 30px;
		text-align: center;
		text-shadow: 0 1px 0 rgba(255,255,255,0.2);
		border-radius: 15px 15px 15px 0px;
	}
	.form input[type="submit"],
	.form input[type="button"]
	{
		display: block;
		color: #FFF;
		margin: 0 auto;
		background: #1abc9c;
		font-size: 14px;
		text-align: center;
		border: 1px solid #16a085;
		border-width: 1px 1px 3px;
	}
	.form input[type="submit"]:hover,
	.form input[type="button"]:hover
	{
		background: #109177;
	}
</style>

</html>
