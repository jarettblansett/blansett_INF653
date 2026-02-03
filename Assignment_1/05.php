<?php
// Improve code readability by adding appropriate comments.
//• Add comments to explain each line of the code.
//• Use different comment styles (//, #, /* */).
//• Expected Output: Total price: $40

$price = 50; // Original price of item
$discount = 10; # Discount amount to be subtracted from original price
$finalPrice = $price - $discount; /* Total after applying discount */
echo "Total price: $" . $finalPrice; // Displaying final price to the user
?>