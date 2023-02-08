#Dev Note - I have a working solution bar one small error, for whatever reason in the cartTotal function in \src\Shop\Cart.php line 205, the returned total is the Product objects property name $unitPrice and I for the life of me can't figure out why.  Anyway, happy to discuss and thanks for the opportunity in the tech test which was fun getting back into some OOP and coding.  Hope to hear from you, thanks.


Aphix Software Engineering Assessment

Task

The repo above contains a bare bones Symfony application which implements some basic product listing functionality. The goal is to implement the below User story in the most  appropriate way possible. Some code is provided as a guideline but does not need to be  followed and candidates are encouraged to improve on the codebase through their solution.
Submissions
You may submit responses through any of the following:
•	Forked PHP Sandbox link
•	Github link (or vendor of your preference)
•	Zip file of the code (if no other options are available).
User Story
What
Implement a checkout page within the assessment project that is able to display a list of products in a cart. The list should include product name, quantity in cart, the net price, VAT amount and subtotal of each product.
The checkout page should also show the net total, sub total (incl VAT) and gross total of the cart.
The layout of the page can be a basic representation of this data.
HOW
•	Retrieve the cart contents from the following api endpoint https://63187261f6b281877c6c9805.mockapi.io/api/v1/cart
•	To calculate the item totals use the following calculations rounded to 2 decimal places:
•	Net price - unitPrice * quantity O VAT price - (Net price * (23.0 / 100.0)) o Item total - Net price + VAT price
•	To calculate the cart totals use the following calculations: o Net total - Sum of all net prices
 VAT total - Sum of all VAT prices o Item total - Sum of all item totals
