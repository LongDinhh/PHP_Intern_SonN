<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		<input type="submit" name="original" value="Original">
		<input type="submit" name="saveOrder" value="Save Order"><br/>
		<input type="submit" name="sortPriceAsc" value="Sort Price Asc">
        <input type="submit" name="sortPriceDesc" value="Sort Price Desc"><br/>
        <input type="submit" name="sortOrderAsc" value="Sort Order Asc">
        <input type="submit" name="sortOrderDesc" value="Sort Order Desc"><br/>
        <input type="submit" name="sortTotalMoneyAsc" value="Sort Total Money Asc">
		<input type="submit" name="sortTotalMoneyDesc" value="Sort Total Money Desc"><br/>
	</form>
    <table border="1" cellpadding="0" cellspacing="0">
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Order</td>
            <td>Total Money</td>
        </tr>
    <?php
        $products = main();
        for($i = 0; $i < 10; $i++){
            echo '<tr>';
            echo '<td>';
            echo $products[$i]['id'];
            echo '</td>';
            echo '<td>';
            echo $products[$i]['name'];
            echo '</td>';
            echo '<td>';
            echo $products[$i]['price'];
            echo '</td>';
            echo '<td>';
            echo $products[$i]['quantity'];
            echo '</td>';
            echo '<td>';
            echo '<input type="text" name="order[]" value="'.$products[$i]['order'].'">';
            echo '</td>';
            echo '<td>';
            echo $products[$i]['price']*$products[$i]['order'];
            echo '</td>';
            echo '</tr>';
        }
    ?>
    </table>
	<?php
		function products(){
			$product1 = [
				'id' => 1,
				'name' => 'Cocacola',
				'price' => 10000,
				'quantity' => 1000,
				'order' => 0
			];
			$product2 = [
				'id' => 2,
				'name' => 'Pessi',
				'price' => 11000,
				'quantity' => 500,
				'order' => 0
			];
			$product3 = [
				'id' => 3,
				'name' => 'Sting',
				'price' => 9000,
				'quantity' => 720,
				'order' => 0
			];
			$product4 = [
				'id' => 4,
				'name' => 'Sprite',
				'price' => 10000,
				'quantity' => 100,
				'order' => 0
			];
			$product5 = [
				'id' => 5,
				'name' => 'Lavie',
				'price' => 11000,
				'quantity' => 440,
				'order' => 0
			];
			$product6 = [
				'id' => 6,
				'name' => 'Aquarius',
				'price' => 12000,
				'quantity' => 150,
				'order' => 0
			];
			$product7 = [
				'id' => 7,
				'name' => 'Number1',
				'price' => 10000,
				'quantity' => 300,
				'order' => 0
			];
			$product8 = [
				'id' => 8,
				'name' => 'Red Bull',
				'price' => 15000,
				'quantity' => 600,
				'order' => 0
			];
			$product9 = [
				'id' => 9,
				'name' => '7 Up',
				'price' => 10000,
				'quantity' => 500,
				'order' => 0
			];
			$product10 = [
				'id' => 10,
				'name' => 'Fanta',
				'price' => 8000,
				'quantity' => 400,
				'order' => 0
			];
			$products = array($product1, $product2, $product3, $product4, $product5, $product6, $product7, $product8, $product9, $product10);
			return $products;
		}
		function validateOrder($input, $products){
			for ($i=0; $i < 10; $i++) { 
				if(is_numeric($input[$i])){
					if($input[$i] > 0 && $input[$i] < $products[$i]['quantity']){
						return 1;
					}
					else return 0;
				}
				else return 0;
			}
		}
		function order($input, $products){
			for ($i=0; $i < 10; $i++) { 
				$products[$i]['order'] = $input[$i];
			}
			return $products;
		}
		function sortId($products){
			for ($i=0; $i < 9; $i++) { 
            	for ($j=$i + 1; $j < 10; $j++) { 
            		if($products[$i]['order'] === $products[$j]['order'] && $products[$i]['id'] > $products[$j]['id']){
            			$tmp = $products[$j];
                       	$products[$j] = $products[$i];
                        $products[$i] = $tmp;
            		}
            	}
            }
		}
		function sortPriceAsc($products){
			for ($i=0; $i < 9; $i++) { 
				for ($j=$i + 1; $j < 10; $j++) { 
					if(($products[$i])['price'] > ($products[$j])['price']){
						$tmp = $products[$j];
						$products[$j] = $products[$i];
						$products[$i] = $tmp;
					}
				}
			}
			return $products;
		}
		function sortPriceDesc($products){
			for ($i=0; $i < 9; $i++) { 
                for ($j=$i + 1; $j < 10; $j++) { 
                    if(($products[$i])['price'] < ($products[$j])['price']){
                        $tmp = $products[$j];
                        $products[$j] = $products[$i];
                        $products[$i] = $tmp;
                    }
                }
            }
            return $products;
		}
		function sortOrderAsc($products){
			for($i = 0; $i < 9; $i++){
				for($j = $i + 1; $j < 10; $j++){
					if(($products[$i])['order'] > ($products[$j])['order']){
						$tmp = $products[$j];
						$products[$j] = $products[$i];
						$products[$i] = $tmp;
					}
				}
			}
			return $products;
		}
		function sortOrderDesc($products){
			for($i = 0; $i < 9; $i++){
                for($j = $i + 1; $j < 10; $j++){
                    if(($products[$i])['order'] < ($products[$j])['order']){
                        $tmp = $products[$j];
                        $products[$j] = $products[$i];
                        $products[$i] = $tmp;
                    }
                }
            }
            return $products;
		}
		function sortTotalMoneyAsc($products){
			for($i = 0; $i < 9; $i++){
				for($j = $i + 1; $j < 10; $j++){
					if(($products[$i])['price']*($products[$i])['order'] > ($products[$j])['price']*($products[$j])['order']){
						$tmp = $products[$j];
						$products[$j] = $products[$i];
						$products[$i] = $tmp;
					}
				}
			}
			return $products;
		}
		function sortTotalMoneyDesc($products){
			for($i = 0; $i < 9; $i++){
                for($j = $i + 1; $j < 10; $j++){
                    if(($products[$i])['price']*($products[$i])['order'] < ($products[$j])['price']*($products[$j])['order']){
                        $tmp = $products[$j];
                        $products[$j] = $products[$i];
                        $products[$i] = $tmp;
                    }
                }
            }
            return $products;
		}
		function main(){
            $products = products();
            if(isset($_POST['saveOrder'])){ 
            	$input = $_POST['order'];
            	if(validateOrder($input, $products) === 1){
            		$productsOrder = order($input, $products);
            		$productsStart = sortOrderAsc($productsOrder);
            		$productsEnd = sortId($productsStart);
            		return $productsEnd;
            	}
            }
            if(isset($_POST['original'])){
                $productsEnd = products();
                return $productsEnd;
			}
			if(isset($_POST['sortPriceAsc'])){
                $productsEnd = sortPriceAsc($products);
                return $productsEnd;
			}
            if(isset($_POST['sortPriceDesc'])){
                $productsEnd = sortPriceDesc($products);
                return $productsEnd;
            }
            if(isset($_POST['sortOrderAsc'])){
                $productsEnd = sortOrderAsc($products);
                return $productsEnd;
            }
            if(isset($_POST['sortOrderDesc'])){
                $productsEnd = sortOrderDesc($products);
                return $productsEnd;
            }
            if(isset($_POST['sortTotalMoneyAsc'])){
                $productsEnd = sortTotalMoneyAsc($products);
                return $productsEnd;
            }
            if(isset($_POST['sortTotalMoneyDesc'])){
                $productsEnd = sortTotalMoneyDesc($products);
                return $productsEnd;
            }
		}
	?>
</body>
</body>
</html>