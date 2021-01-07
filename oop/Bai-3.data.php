<?php
$listMenu = array(
    array(
        'id' => '01',
        'name' => 'chicken',
        'price' => 100000,
        'fee' => 0
    ),
    array(
        'id' => '02',
        'name' => 'beef',
        'price' => 150000,
        'fee' => 0
    ),
    array(
        'id' => '03',
        'name' => 'tomato',
        'price' => 50000,
        'fee' => 0
    ),
    array(
        'id' => '04',
        'name' => 'fish',
        'price' => 80000,
        'fee' => 0
    ),
    array(
        'id' => '05',
        'name' => 'cocacola',
        'price' => 10000,
        'fee' => 0
    ),
    array(
        'id' => '06',
        'name' => 'pepsi',
        'price' => 11000,
        'fee' => 0
    ),
    array(
        'id' => '07',
        'name' => 'sting',
        'price' => 9000,
        'fee' => 0
    ),
    array(
        'id' => '08',
        'name' => 'wine',
        'price' => 40000,
        'fee' => 10000
    ),
    array(
        'id' => '09',
        'name' => 'beer',
        'price' => 20000,
        'fee' => 5000
    ),
    array(
        'id' => '10',
        'name' => 'moijto',
        'price' => 50000,
        'fee' => 12000
    )
);
$listStaff = array(
    array(
        'id' => '01',
        'name' => 'Nguyen Van A',
        'type' => 1,
        'salary' => 0
    ),
    array(
        'id' => '02',
        'name' => 'Nguyen Thi B',
        'type' => 0,
        'salary' => 0
    ),
    array(
        'id' => '03',
        'name' => 'Tran Van C',
        'type' => 1,
        'salary' => 0
    ),
    array(
        'id' => '04',
        'name' => 'Tran Thi D',
        'type' => 0,
        'salary' => 0
    ),
    array(
        'id' => '05',
        'name' => 'Le Văn E',
        'type' => 0,
        'salary' => 0
    ),
    array(
        'id' => '06',
        'name' => 'Le Thi F',
        'type' => 0,
        'salary' => 0
    )
);
$listTable = array(
    array(
        'id' => '01',
        'status' => 1,
        'id_bill' => '02'
    ),
    array(
        'id' => '02',
        'status' => 0,
        'id_bill' => '04'
    ),
    array(
        'id' => '03',
        'status' => 1,
        'id_bill' => '01'
    ),
    array(
        'id' => '04',
        'status' => 0,
        'id_bill' => '03'
    )
);
$listBill = array(
    array(
        'id' => '01',
        'id_table' => '02',
        'check_in' => '08:00:00',
        'check_out' => '12:00:00',
        'money_for_menu' => 0,
        'money_for_staff' => 0,
        'total_money' => 0
    ),
    array(
        'id' => '02',
        'id_table' => '04',
        'check_in' => '09:00:00',
        'check_out' => '12:00:00',
        'money_for_menu' => 0,
        'money_for_staff' => 0,
        'total_money' => 0
    ),
    array(
        'id' => '03',
        'id_table' => '01',
        'check_in' => '10:00:00',
        'check_out' => '14:00:00',
        'money_for_menu' => 0,
        'money_for_staff' => 0,
        'total_money' => 0
    ),
    array(
        'id' => '04',
        'id_table' => '03',
        'check_in' => '08:00:00',
        'check_out' => '13:00:00',
        'money_for_menu' => 0,
        'money_for_staff' => 0,
        'total_money' => 0
    )
);
$listOrder = array(
    array(
        'id_menu' => '01',
        'quantity' => 2,
        'id_bill' => '01'
    ),
    array(
        'id_menu' => '05',
        'quantity' => 1,
        'id_bill' => '01'
    ),
    array(
        'id_menu' => '02',
        'quantity' => 1,
        'id_bill' => '01'
    ),
    array(
        'id_menu' => '08',
        'quantity' => 2,
        'id_bill' => '02'
    ),
    array(
        'id_menu' => '04',
        'quantity' => 3,
        'id_bill' => '02'
    ),
    array(
        'id_menu' => '10',
        'quantity' => 1,
        'id_bill' => '02'
    ),
    array(
        'id_menu' => '02',
        'quantity' => 2,
        'id_bill' => '03'
    ),
    array(
        'id_menu' => '09',
        'quantity' => 4,
        'id_bill' => '03'
    ),
    array(
        'id_menu' => '03',
        'quantity' => 2,
        'id_bill' => '04'
    ),
    array(
        'id_menu' => '06',
        'quantity' => 1,
        'id_bill' => '04'
    )
);
$listCallStaff = array(
    array(
        'id_staff' => '01',
        'id_bill' => '01',
        'start_time' => '08:00:00',
        'end_time' => '10:00:00'
    ),
    array(
        'id_staff' => '02',
        'id_bill' => '01',
        'start_time' => '09:00:00',
        'end_time' => '11:00:00'
    ),
    array(
        'id_staff' => '03',
        'id_bill' => '01',
        'start_time' => '09:00:00',
        'end_time' => '12:00:00'
    ),
    array(
        'id_staff' => '04',
        'id_bill' => '02',
        'start_time' => '09:00:00',
        'end_time' => '10:00:00'
    ),
    array(
        'id_staff' => '01',
        'id_bill' => '02',
        'start_time' => '10:00:00',
        'end_time' => '12:00:00'
    ),
    array(
        'id_staff' => '05',
        'id_bill' => '03',
        'start_time' => '11:00:00',
        'end_time' => '12:00:00'
    ),
    array(
        'id_staff' => '06',
        'id_bill' => '03',
        'start_time' => '10:00:00',
        'end_time' => '14:00:00'
    ),
    array(
        'id_staff' => '03',
        'id_bill' => '03',
        'start_time' => '12:00:00',
        'end_time' => '14:00:00'
    ),
    array(
        'id_staff' => '05',
        'id_bill' => '04',
        'start_time' => '08:00:00',
        'end_time' => '11:00:00'
    ),
    array(
        'id_staff' => '02',
        'id_bill' => '04',
        'start_time' => '11:00:00',
        'end_time' => '13:00:00'
    ),
);
?>