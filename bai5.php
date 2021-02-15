<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <form method="post">
        <input type="submit" name="original" value="Original">
        <input type="submit" name="saveOrder" value="Save Order">
        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Order</th>
            </tr>
            <?php
            $products = main();?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td ><?php echo $product['id'] ?></td>
                        <td><?php echo $product['name'] ?></td>
                        <td><?php echo $product['price'] ?></td>
                        <td><?php echo $product['quantity'] ?></td>
                        <td><input type="number" name="<?php echo 'orderInput['.$product['id'].']' ?>" value="<?php echo $product['order']?>"></td>
                    </tr>
                <?php endforeach ?>
        </table>
    </form>
<?php
    function validateOrder($products, $count, $orderInput){
        for ($i=0; $i < $count; $i++){
            if ($orderInput[$products[$i]['id']] < 0 || $orderInput[$products[$i]['id']] > $products[$i]['quantity']){
                return [
                    'code' => 0,
                    'message' => 'Order phải lớn hơn 0 và nhỏ hơn Quantity'
                ];
            }
        }
        return [
            'code' => 1,
            'message' => ''
        ];
    }
    function saveOrder($products, $count, $orderInput){
        for ($i=0; $i < $count; $i++){
            $products[$i]['order'] = $orderInput[$products[$i]['id']];
        }
        return $products;
    }
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
    function sortOrderById($products, $count){
        for ($i = 0; $i < $count - 1; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                if ($products[$i]['order'] === $products[$j]['order'] && $products[$i]['id'] > $products[$j]['id']) {
                    $tmp = $products[$i];
                    $products[$i] = $products[$j];
                    $products[$j] = $tmp;
                }
            }
        }
        return $products;
    }
    function main(){
        $products =
            [
                [
                    'id' => 1,
                    'name' => 'Cocacola',
                    'price' => 10000,
                    'quantity' => 10,
                    'order' => 0
                ], [
                    'id' => 2,
                    'name' => 'Pessi',
                    'price' => 11000,
                    'quantity' => 8,
                    'order' => 0
                ], [
                    'id' => 3,
                    'name' => 'Sting',
                    'price' => 9000,
                    'quantity' => 7,
                    'order' => 0
                ], [
                    'id' => 4,
                    'name' => 'Sprite',
                    'price' => 10000,
                    'quantity' => 10,
                    'order' => 0
                ], [
                    'id' => 5,
                    'name' => 'Lavie',
                    'price' => 11000,
                    'quantity' => 6,
                    'order' => 0
                ], [
                    'id' => 6,
                    'name' => 'Aquarius',
                    'price' => 12000,
                    'quantity' => 7,
                    'order' => 0
                ], [
                    'id' => 7,
                    'name' => 'Number1',
                    'price' => 10000,
                    'quantity' => 6,
                    'order' => 0
                ], [
                    'id' => 8,
                    'name' => 'Red Bull',
                    'price' => 15000,
                    'quantity' => 8,
                    'order' => 0
                ], [
                    'id' => 9,
                    'name' => '7 Up',
                    'price' => 10000,
                    'quantity' => 7,
                    'order' => 0
                ], [
                    'id' => 10,
                    'name' => 'Fanta',
                    'price' => 8000,
                    'quantity' => 9,
                    'order' => 0
                ]
            ];
        $count = count($products);
        if (isset($_POST['original'])) {
            return $products;
        }
        if (isset($_POST['saveOrder'])) {
            $orderInput = $_POST['orderInput'];
            $validateOrder = validateOrder($products, $count, $orderInput);
            if ($validateOrder['code'] === 0){
                echo $validateOrder['message'];
                return $products;
            }
            $saveOrder = saveOrder($products, $count, $orderInput);
            $sortOrderAsc = sortAsc($saveOrder, $count, 'order');
            $sortOrderById = sortOrderById($sortOrderAsc, $count);
            return $sortOrderById;
        }
    }
?>
</body>
</html>