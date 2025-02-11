<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="styleinsert.css">
<?php include 'navbar.php';?>

<div class="row">
    <div class="column">
        <h2>Product Inventory</h2>
        <form action="insert2.php" method="POST">
            <input type="text" name="Item" placeholder="Enter Item Name"><br>
            <input type="number" name="Portion_Calories" placeholder="Portion Calories"><br>
            <input type="text" name="Portion_Weight" placeholder="Portion Per Weight"><br>
            <input type="number" name="Per_100g_Calories" placeholder="Per 100g Calories"><br><br>
            Energy Content: <br>
            <select name="Energy_Content">
                <option value="">---SELECT BELOW---</option>
                <option value="Low calorie">Low calorie</option>
                <option value="Low / portion">Low / portion</option>
                <option value="Low-Med">Low-Med</option>
                <option value="Medium">Medium</option>
                <option value="Med-High">Med-High</option>
                <option value="High">High</option>
            </select>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <div class="column">
        <?php include 'D:\xampp\htdocs\sanoy_11gates\PT8\table.php'; ?>
    </div>
</div>