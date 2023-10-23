<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div id="print_view" style="display:none;">
    <h3 class="text-center">Print View</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="print_table_body">
            <!-- Table rows will be added dynamically here -->
        </tbody>
    </table>
</div>

<script type="text/javascript">
	function saleBtn() {
    // ... Your existing code ...

    const printTableBody = document.getElementById("print_table_body");

    // Create a new row in the print view table
    const newRow = printTableBody.insertRow();

    // Insert cells into the new row and set content
    const cellProductName = newRow.insertCell(0);
    cellProductName.innerHTML = selectedProduct;

    const cellProductPrice = newRow.insertCell(1);
    cellProductPrice.innerHTML = productPrice;

    const cellProductQuantity = newRow.insertCell(2);
    cellProductQuantity.innerHTML = productQuantity;

    const cellProductTotal = newRow.insertCell(3);
    cellProductTotal.innerHTML = productTotal;

    // Increment the index for the next row
    rowIndex++;
}

</script>
</body>
</html>