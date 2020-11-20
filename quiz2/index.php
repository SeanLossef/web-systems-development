<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quiz 2</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>The Quiz 2 Store</h1>

    <div class="cont">
        <h2>Items for sale</h2>

        <a class="button" href="/">Items</a>
        <a class="button" href="/?discount">Apply Discounts</a>
        <a class="button" href="/?average">Average</a>

        <table class="results">
            <?php
                try {
                    $conn = new PDO("mysql:host=localhost;dbname=websys_quiz", 'root', '');

                    if (isset($_GET['discount']))
                        $pstmt = $conn->prepare('SELECT *,
                                IFNULL(ROUND(items.price*(1-discounts.discount),2), price) AS discounted_price,
                                ROUND(IFNULL(discount,0)*100) AS discount_percent
                            FROM items
                            LEFT JOIN discounts
                            ON items.id=discounts.item_id
                            ORDER BY discounted_price;');

                    elseif (isset($_GET['average']))
                        $pstmt = $conn->prepare('SELECT 
                                "Average Discounted Price" AS name,
                                0 AS price,
                                0 AS discount,
                            ROUND(AVG(IFNULL(ROUND(items.price*(1-discounts.discount),2), price)), 2) AS discounted_price
                            FROM items
                            LEFT JOIN discounts
                            ON items.id=discounts.item_id
                            WHERE discount!=0
                            ORDER BY price;');

                    else
                        $pstmt = $conn->prepare('SELECT *,
                                IFNULL(ROUND(items.price*(1-discounts.discount),2), price) AS discounted_price,
                                ROUND(IFNULL(discount,0)*100) AS discount_percent
                            FROM items
                            LEFT JOIN discounts
                            ON items.id=discounts.item_id
                            ORDER BY price;');

                    $pstmt->execute();
                    $items = $pstmt->fetchALL();

                    foreach ($items as $item) {
                        print("<tr>
                            <td class='name'>".$item['name']."</td>
                            <td class='price'>".($item['price']==0?"":"$".number_format($item['price'], 2))."</td>
                            <td class='discount'>".($item['discount']==0?"":"<span>".$item['discount_percent']."% OFF!</span>")."</td>
                            <td class='discounted'><span>You pay</span>$".number_format($item['discounted_price'], 2)."</td>
                        </tr>");
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            ?>
        </table>
    </div>
</body>
</html>