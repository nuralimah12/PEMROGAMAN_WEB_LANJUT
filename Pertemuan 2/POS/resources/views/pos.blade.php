<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Point of Sale - Create Transaction</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Create Transaction</div>
            <div class="card-body">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="product_id">Product Category:</label>
                        <select name="product_id" id="product_id" required>
                            <option value="1">FOOD BEVERAGE</option>
                            <option value="2">BEAUTY HEALTH</option>
                            <option value="3">HOME CARE</option>
                            <option value="4">BABY KID</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="product">Product Name:</label>
                        <input type="text" name="product" id="product" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" name="price" id="price">
                    </div>
                    <div class="form-group">
                        <label for="total">Total Price:</label>
                        <input type="number" name="total" id="total">
                    </div>
                    <button type="submit">Create Transaction</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
