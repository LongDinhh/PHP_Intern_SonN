<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		<input type="submit" name="original" value="Original"><br/>
		<input type="submit" name="sortPriceAsc" value="Sort Price Asc">
        <input type="submit" name="sortPriceDesc" value="Sort Price Desc"><br/>
        <input type="submit" name="sortOrderAsc" value="Sort Order Asc">
        <input type="submit" name="sortOrderDesc" value="Sort Order Desc"><br/>
        <input type="submit" name="sortTotalMoneyAsc" value="Sort Total Money Asc">
		<input type="submit" name="sortTotalMoneyDesc" value="Sort Total Money Desc"><br/>
	</form>
	<table border="1" cellpadding="0" cellspacing="0">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Order</th>
            <th>Total Money</th>
        </tr>
        <?php
        	$products = main();?>
		<?php foreach ($products as $product): ?>
        		<tr>
        			<td><?php echo $product['id'] ?></td>
        			<td><?php echo $product['name'] ?></td>
        			<td><?php echo $product['price'] ?></td>
        			<td><?php echo $product['quantity'] ?></td>
        			<td><?php echo $product['order'] ?></td>
        			<td><?php echo $product['price']*$product['order'] ?></td>
        	 	</tr>
        <?php endforeach ?>
    </table>
	<?php
		function sortAsc($products, $count, $column){
			for ($i = 0; $i < $count - 1; $i++) { 
                for ($j = $i + 1; $j < $count; $j++) {
                    if($products[$i][$column] > $products[$j][$column]){
                        $tmp = $products[$j];
                        $products[$j] = $products[$i];
                        $products[$i] = $tmp;
                    }
                }
            }
            return $products;
		}
		function sortDesc($products, $count, $column){
			for ($i = 0; $i < $count - 1; $i++) { 
                for ($j = $i + 1; $j < $count; $j++) {
                    if($products[$i][$column] < $products[$j][$column]){
                        $tmp = $products[$j];
                        $products[$j] = $products[$i];
                        $products[$i] = $tmp;
                    }
                }
            }
            return $products;
		}
		function main(){
			$products = [
			   [
				'id' => 1,
				'name' => 'Cocacola',
				'price' => 10000,
				'quantity' => 1000,
				'order' => 9
			], [
				'id' => 2,
				'name' => 'Pessi',
				'price' => 11000,
				'quantity' => 500,
				'order' => 7
			], [
				'id' => 3,
				'name' => 'Sting',
				'price' => 9000,
				'quantity' => 720,
				'order' => 8
			], [
				'id' => 4,
				'name' => 'Sprite',
				'price' => 10000,
				'quantity' => 100,
				'order' => 10
			], [
				'id' => 5,
				'name' => 'Lavie',
				'price' => 11000,
				'quantity' => 440,
				'order' => 4
			], [
				'id' => 6,
				'name' => 'Aquarius',
				'price' => 12000,
				'quantity' => 150,
				'order' => 9
			], [
				'id' => 7,
				'name' => 'Number1',
				'price' => 10000,
				'quantity' => 300,
				'order' => 3
			], [
				'id' => 8,
				'name' => 'Red Bull',
				'price' => 15000,
				'quantity' => 600,
				'order' => 4
			], [
				'id' => 9,
				'name' => '7 Up',
				'price' => 10000,
				'quantity' => 500,
				'order' => 5
			], [
				'id' => 10,
				'name' => 'Fanta',
				'price' => 8000,
				'quantity' => 400,
				'order' => 6
			]
			];
			$count = count($products);
			if (isset($_POST['original'])) {
				return $products;	
			}
			if (isset($_POST['sortPriceAsc'])) {
            	$sortPriceAsc = sortAsc($products, $count, 'price');
            	return $sortPriceAsc;
            }
            if (isset($_POST['sortPriceDesc'])) {
            	$sortPriceDesc = sortDesc($products, $count, 'price');
            	return $sortPriceDesc;
            }
            if (isset($_POST['sortOrderAsc'])) {
            	$sortOrderAsc = sortAsc($products, $count, 'order');
            	return $sortOrderAsc;
            }
            if (isset($_POST['sortOrderDesc'])) {
            	$sortOrderDesc = sortDesc($products, $count, 'order');
            	return $sortOrderDesc;
            }
            for ($i=0; $i < $count; $i++) { 
            	$products[$i]['totalMoney'] = $products[$i]['price']*$products[$i]['order'];
            }
            if (isset($_POST['sortTotalMoneyAsc'])) {
            	$sortTotalMoneyAsc = sortAsc($products, $count, 'totalMoney');
            	return $sortTotalMoneyAsc;
            }
            if (isset($_POST['sortTotalMoneyDesc'])) {
            	$sortTotalMoneyDesc = sortDesc($products, $count, 'totalMoney');
            	return $sortTotalMoneyDesc;
            }
		}
		
	?>
</body>
</html>