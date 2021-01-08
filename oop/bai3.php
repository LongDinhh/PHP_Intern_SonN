</!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form method="post">
    <input type="submit" name="menu" value="Menu">
    <input type="submit" name="staff" value="Staff">
    <input type="submit" name="table" value="Table">
    <input type="submit" name="bill" value="Bill">
</form>
<?php
require 'Bai-3.data.php';
class Menu {
    public $id;
    public $name;
    public $price;
    public $fee;
    public function __construct($id, $name, $price, $fee)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->fee = $fee;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getFee()
    {
        return $this->fee;
    }
}
class Staff{
    public $id;
    public $name;
    public $type;
    public $salary;
    public function __construct($id, $name, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }
    public function getId(){
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getType()
    {
        return $this->type;
    }
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }
    public function getSalary()
    {
        return $this->salary;
    }
}
class Table{
    public $id;
    public $status;
    public function __construct($id, $status)
    {
        $this->id = $id;
        $this->status = $status;
    }
    public function getId(){
        return $this->id;
    }
    public function getStatus(){
        return $this->status;
    }
}
class Bill{
    public $id;
    public $idTable;
    public $checkIn;
    public $checkOut;
    public $moneyForMenu;
    public $moneyForStaff;
    public $moneyDown;
    public $totalMoney;
    public function __construct($id, $idTable, $checkIn, $checkOut, $moneyDown)
    {
        $this->id = $id;
        $this->idTable = $idTable;
        $this->checkIn = $checkIn;
        $this->checkOut = $checkOut;
        $this->moneyDown = $moneyDown;
    }
    public function getId(){
        return $this->id;
    }
    public function getIdTable(){
        return $this->idTable;
    }
    public function getCheckIn(){
        return $this->checkIn;
    }
    public function getCheckOut(){
        return $this->checkOut;
    }
    public function setMoneyForMenu($moneyForMenu)
    {
        $this->moneyForMenu = $moneyForMenu;
    }
    public function getMoneyForMenu()
    {
        return $this->moneyForMenu;
    }
    public function setMoneyForStaff($moneyForStaff)
    {
        $this->moneyForStaff = $moneyForStaff;
    }
    public function getMoneyForStaff()
    {
        return $this->moneyForStaff;
    }
    public function setTotalMoney($totalMoney)
    {
        $this->totalMoney = $totalMoney;
    }
    public function getMoneyDown()
    {
        return $this->moneyDown;
    }
    public function getTotalMoney()
    {
        return $this->totalMoney;
    }
}
class Calculate{
    public function moneyForMenu($listOrder, $listMenu, $bill)
    {
        $orderForBill = [];
        foreach ($listOrder as $order)
        {
            if ($order['id_bill'] === $bill['id'])
            {
                array_push($orderForBill, $order);
            }
        }
        foreach ($orderForBill as $value)
        {
            foreach ($listMenu as $item)
            {
                if ($value['id_menu'] === $item['id'])
                {
                    $bill['money_for_menu'] += $value['quantity']*$item['price']+$item['fee'];
                }
            }
        }
        return $bill['money_for_menu'];
    }
    public function moneyForStaff($listCallStaff, $bill)
    {
        $staffForBill = [];
        foreach ($listCallStaff as $callStaff)
        {
            if ($callStaff['id_bill'] === $bill['id'])
            {
                array_push($staffForBill, $callStaff);
            }
        }
        $count1 = count($staffForBill);
        $n = (strtotime($bill['check_out']) - strtotime($bill['check_in']))/3600;
        $staffForHour = [];
        for ($i = 0; $i < $n; $i++)
        {
            $staffForHour[$i] = 0;
            for ($j = 0; $j < $count1; $j++)
            {
                if (((strtotime($bill['check_in']) - strtotime($staffForBill[$j]['start_time']))/3600 + $i) >= 0 && ((strtotime($staffForBill[$j]['end_time']) - strtotime($bill['check_in']))/3600 - $i - 1) >= 0)
                {
                    $staffForHour[$i]++;
                }
            }
        }
        $count2 = count($staffForHour);
        if ($staffForHour[0] === 1 && $staffForHour[1] === 1) {
            $bill['money_for_staff'] += 100000 + 80000;
            for ($i = 2; $i < $count2; $i++) {
                if ($staffForHour[$i] === 1) {
                    $bill['money_for_staff'] += 50000;
                }
                if ($staffForHour[$i] >= 2) {
                    $bill['money_for_staff'] += 40000*$staffForHour[$i];
                }
            }
        }
        if ($staffForHour[0] === 1 && $staffForHour[1] >= 2) {
            $bill['money_for_staff'] += 100000 + 60000*$staffForHour[1];
            for ($i = 2; $i < $count2; $i++) {
                if ($staffForHour[$i] === 1) {
                    $bill['money_for_staff'] += 50000;
                }
                if ($staffForHour[$i] >= 2) {
                    $bill['money_for_staff'] += 40000*$staffForHour[$i];
                }
            }
        }
        if ($staffForHour[0] >= 2 && $staffForHour[1] === 1)
        {
            $bill['money_for_staff'] += 80000*$staffForHour[0] + 80000;
            for ($i=2; $i<$count2; $i++)
            {
                if ($staffForHour[$i] === 1)
                {
                    $bill['money_for_staff'] += 50000;
                }
                if ($staffForHour[$i] >= 2)
                {
                    $bill['money_for_staff'] += 40000*$staffForHour[$i];
                }
            }
        }
        if ($staffForHour[0] >= 2 && $staffForHour[1] >= 2)
        {
            $bill['money_for_staff'] += 80000*$staffForHour[0] + 60000*$staffForHour[1];
            for ($i=2; $i<$count2; $i++)
            {
                if ($staffForHour[$i] === 1)
                {
                    $bill['money_for_staff'] += 50000;
                }
                if ($staffForHour[$i] >= 2)
                {
                    $bill['money_for_staff'] += 40000*$staffForHour[$i];
                }
            }
        }
        return $bill['money_for_staff'];
    }
    public function salary($staff, $listCallStaff, $listBill)
    {
        $billOfStaff = [];
        foreach ($listCallStaff as $callStaff)
        {
            if ($staff['id'] === $callStaff['id_staff'])
            {
                array_push($billOfStaff, $callStaff);
            }
        }
        $hourStaffForBill = [];
        foreach ($billOfStaff as $value)
        {
            $n = (strtotime($value['end_time']) - strtotime($value['start_time']))/3600;
            array_push($hourStaffForBill, $n);
        }
        $numberStaffOfHour = [];
        for ($i=0; $i<count($hourStaffForBill); $i++)
        {
            for ($j=0; $j<$hourStaffForBill[$i]; $j++)
            {
                $numberStaffOfHour[$i][$j] = 0;
                foreach ($listCallStaff as $callStaff)
                {
                    if ($billOfStaff[$i]['id_bill'] === $callStaff['id_bill'] && ((strtotime($billOfStaff[$i]['start_time']) - strtotime($callStaff['start_time']))/3600 + $j) >= 0 && ((strtotime($callStaff['end_time']) - strtotime($billOfStaff[$i]['start_time']))/3600 - $j - 1) >= 0)
                    {
                        $numberStaffOfHour[$i][$j] += 1;
                    }
                }
            }
        }
        for ($i=0; $i<count($numberStaffOfHour); $i++)
        {
            for($j=0; $j<count($numberStaffOfHour[$i]); $j++)
            {
                foreach ($listBill as $bill)
                {
                    if ($bill['id'] === $billOfStaff[$i]['id_bill'])
                    {
                        if ((strtotime($billOfStaff[$i]['start_time']) - strtotime($bill['check_in']))/3600 + $j === 0 && $numberStaffOfHour[$i][$j] === 1)
                        {
                            $staff['salary'] += 0.4*100000;
                        }
                        if ((strtotime($billOfStaff[$i]['start_time']) - strtotime($bill['check_in']))/3600 + $j === 0 && $numberStaffOfHour[$i][$j] >= 2)
                        {
                            $staff['salary'] += 0.4*80000;
                        }
                        if ((strtotime($billOfStaff[$i]['start_time']) - strtotime($bill['check_in']))/3600 + $j === 1 && $numberStaffOfHour[$i][$j] === 1)
                        {
                            $staff['salary'] += 0.4*80000;
                        }
                        if ((strtotime($billOfStaff[$i]['start_time']) - strtotime($bill['check_in']))/3600 + $j === 1 && $numberStaffOfHour[$i][$j] >= 2)
                        {
                            $staff['salary'] += 0.4*60000;
                        }
                        if ((strtotime($billOfStaff[$i]['start_time']) - strtotime($bill['check_in']))/3600 + $j >= 2 && $numberStaffOfHour[$i][$j] === 1)
                        {
                            $staff['salary'] += 0.4*50000;
                        }
                        if ((strtotime($billOfStaff[$i]['start_time']) - strtotime($bill['check_in']))/3600 + $j >= 2 && $numberStaffOfHour[$i][$j] >= 2)
                        {
                            $staff['salary'] += 0.4*40000;
                        }
                    }
                }
            }
        }
        foreach ($listBill as $bill)
        {
            foreach ($billOfStaff as $value)
            {
                if ($bill['id'] === $value['id_bill'] && $staff['type'] === 1)
                {
                    $staff['salary'] += $bill['total_money']*0.015;
                }
                if ($bill['id'] === $value['id_bill'] && $staff['type'] === 0)
                {
                    $staff['salary'] += $bill['total_money']*0.01;
                }
            }
        }
        return $staff['salary'];
    }
}
$calculate = new Calculate();
$menu = [];
foreach ($listMenu as $value)
{
    $menu[] = new Menu($value['id'], $value['name'], $value['price'], $value['fee']);
}
if (isset($_POST['menu']))
{
    foreach ($menu as $value)
    {
        echo 'Id: '.$value->getId().'<br/>';
        echo 'Name: '.$value->getName().'<br/>';
        echo 'Price: '.$value->getPrice().'<br/>';
        echo 'Fee: '.$value->getFee().'<br/>';
        echo '<br/>';
    }
}
$bill = [];
foreach ($listBill as $value)
{
    $bill[] = new Bill($value['id'], $value['id_table'], $value['check_in'], $value['check_out'], $value['money_down']);
}
$countBill = count($listBill);
for ($i=0; $i<$countBill; $i++)
{
    $listBill[$i]['money_for_menu'] = $calculate->moneyForMenu($listOrder, $listMenu, $listBill[$i]);
    $listBill[$i]['money_for_staff'] = $calculate->moneyForStaff($listCallStaff, $listBill[$i]);
    $listBill[$i]['total_money'] = ($listBill[$i]['money_for_menu'] + $listBill[$i]['money_for_staff'])*1.1 - $listBill[$i]['money_down'];
    $bill[$i]->setMoneyForMenu($listBill[$i]['money_for_menu']);
    $bill[$i]->setMoneyForStaff($listBill[$i]['money_for_staff']);
    $bill[$i]->setTotalMoney($listBill[$i]['total_money']);
}
if (isset($_POST['bill']))
{
    foreach ($bill as $value)
    {
        echo 'Id: '.$value->getId().'<br/>';
        echo 'Table: '.$value->getIdTable().'<br/>';
        echo 'Check in: '.$value->getCheckIn().'<br/>';
        echo 'Check out: '.$value->getCheckOut().'<br/>';
        echo 'List order: ';
        foreach ($listOrder as $order)
        {
            if ($value->getId() === $order['id_bill'])
            {
                foreach ($listMenu as $menu)
                {
                    if ($order['id_menu'] === $menu['id'])
                    {
                        echo $menu['name'].'('.$order['quantity'].'): '.$order['quantity']*$menu['price'].', ';
                    }
                }
            }
        }
        echo '<br/>';
        echo 'Money for menu: '.$value->getMoneyForMenu().'<br/>';
        echo 'Call staff: ';
        foreach ($listCallStaff as $callStaff)
        {
            if ($value->getId() === $callStaff['id_bill'])
            {
                foreach ($listStaff as $staff)
                {
                    if ($callStaff['id_staff'] === $staff['id'])
                    {
                        echo $staff['name'].'('.$callStaff['start_time'].'-'.$callStaff['end_time'].')'.', ';
                    }
                }
            }
        }
        echo '<br/>';
        echo 'Money for staff: '.$value->getMoneyForStaff().'<br/>';
        echo 'Money down: '.$value->getMoneyDown().'<br/>';
        echo 'Total money: '.$value->getTotalMoney().' (10% VAT)'.'<br/>';
        echo '<br/>';
    }
}
$staff = [];
foreach ($listStaff as $value)
{
    $staff[] = new Staff($value['id'], $value['name'], $value['type']);
}
$countStaff = count($listStaff);
for ($i=0; $i<$countStaff; $i++)
{
    $listStaff[$i]['salary'] = $calculate->salary($listStaff[$i], $listCallStaff, $listBill);
    $staff[$i]->setSalary($listStaff[$i]['salary']);
}
if (isset($_POST['staff']))
{
    foreach ($staff as $value)
    {
        echo 'Id: '.$value->getId().'<br/>';
        echo 'Name: '.$value->getName().'<br/>';
        if ($value->getType() === 1)
        {
            echo 'Mode staff: Accompany'.'<br/>';
        }
        else echo 'Mode staff: Not accompany'.'<br/>';
        echo 'Salary: '.$value->getSalary().'<br/>';
        echo '<br/>';
    }
}
$table = [];
foreach ($listTable as $value)
{
    $table[] = new Table($value['id'],$value['status']);
}
if (isset($_POST['table']))
{
    foreach ($table as $value)
    {
        echo 'Id: '.$value->getId().'<br/>';
        foreach ($listBill as $bill)
        {
            if ($value->getId() === $bill['id_table'])
            {
                echo 'Bill: '.$bill['id'].'<br/>';
            }
        }
        if ($value->getStatus() === 1)
        {
            echo 'Status: Busy'.'<br/>';
        }
        else echo 'Status: Free'.'<br/>';
        echo '<br/>';
    }
}

?>
</body>
</html>
