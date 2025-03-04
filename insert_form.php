<form action="insert.php" method="POST">
    <table border="1">
        <tr>
            <td><input type="text" name="name" placeholder="Product Name" required></td>
            <td><input type="text" name="p_desc" placeholder="Description" required></td>
            <td>
                <select name="classification_id">
                    <option value="1">Chips</option>
                    <option value="2">Candies</option>
                    <option value="3">Drinks</option>
                    <option value="4">Snacks</option>
                    <option value="5">Noodles</option>
                    <option value="6">Canned Goods</option>
                    <option value="7">Condiments</option>
                    <option value="8">Baking</option>
                    <option value="9">Spreads</option>
                    <option value="10">Sauces</option>
                </select>
            </td>
            <td>
                <select name="storage_id">
                    <option value="1">Storage A</option>
                    <option value="2">Storage B</option>
                    <option value="3">Storage C</option>
                </select>
            </td>
            <td><input type="number" name="num_stck" placeholder="Stock Number" required></td>
            <td><input type="text" name="size" placeholder="Size" required></td>
            <td><input type="date" name="date_delivered" required></td>
            <td><button type="submit" name="submit">Insert</button></td>
        </tr>
    </table>
</form>
