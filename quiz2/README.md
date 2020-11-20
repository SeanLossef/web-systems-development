# Quiz 2

## Part 3

There were errors in the statements, including a missing apostrophe, and that the price values for the first statement were in quotes, but the datatype is a decimal, so the quotes are erronous.

```SQL
INSERT INTO `items` (`id`, `name`, `price`) VALUES (1, 'MacBook Pro', '1299.99'),
	(2, 'OpenBSD Tshirt', 20.0),(3, 'Amazon echo', 99.99),(4, 'Nvidia GTX 2080 Ti', 1499.99),(5, 'AMD Ryzen 9 3900X', 549.99);
INSERT INTO `discounts` (`id`, `item_id`, `discount`) VALUES (1, 1, 0.25),(2, 2, 0.5),(3, 3, 0.75),(4, 5, 0.1);
```

I added the sql statements in prepared statements in the PHP file. Then I checked if a GET variable was set to know which button was pressed.

Each button is just a link to the same PHP file with the respective GET variable set to let the app know what to do.

The page is basically just a table which is then filled with the results of the query. There are 3 queries, one for each button. In general, each query does a join between the items and discounts table, calculating the product of the price and discount if the discount is set. For the average query, the AVG aggregate is applied to the data to get get the average of discounted price. Then it returns the data in the same format as the other queries in order to make the frontend code simpler.

I also used the format_number function in PHP to display prices with commas and proper currency formatting.

I applied some styling to the page, including making the buttons look nice, and laying out the table to display all the items cleanly. I rotated the discount percentage to make it look cool.

## Extra Credit

Prof. Plotka went to RPI
