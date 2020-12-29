</!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		<input type="text" name="input">
		<input type="submit" name="findMember" value="Find Member"><br/>
		<input type="submit" name="member" value="Member">
	</form>
	<?php
		require 'Bai-1.data.php';
		class Member{
			public $code;
			public $name;
			public $age;
			public $gender;
			public $marital;
			public $totalWorkTime;
			public $salary;
			public $workdays;
			public $startWorkTime;
			public $workHour;
			public $hasLunchBreak;
			public function __construct($code, $name, $age, $gender, $marital, $salary, $startWorkTime, $workHour, $hasLunchBreak){
				$this->code = $code;
				$this->name = $name;
				$this->age = $age;
				$this->gender = $gender;
				$this->marital = $marital;
				$this->salary = $salary;
				$this->startWorkTime = $startWorkTime;
				$this->workHour = $workHour;
				$this->hasLunchBreak = $hasLunchBreak;
			}
			public function getCode(){
				return $this->code;
			}
			public function getName(){
				return $this->name;
			}
			public function getAge(){
				return $this->age;
			}
			public function getGender(){
				return $this->gender;
			}
			public function getMarital(){
				return $this->marital;
			}
			public function setTotalWorkTime($totalWorkTime){
				$this->totalWorkTime = $totalWorkTime;
			}
			public function getTotalWorkTime(){
				return $this->totalWorkTime;
			}
			public function getSalary(){
				return $this->salary;
			}
			public function setWorkdays($workdays){
				$this->workdays = $workdays;
			}
			public function getWorkdays(){
				return $this->workdays;
			}
			public function getStartWorkTime(){
				return $this->startWorkTime;
			}
			public function getWorkHour(){
				return $this->workHour;
			}
			public function getHasLunchBreak(){
				return $this->hasLunchBreak;
			}
		}
		class Calculate{
			public function totalWorkTime($member, $listWorkTime){
				$count = count($listWorkTime);
				for ($i=0; $i < $count; $i++) { 
					if ($member['code'] === $listWorkTime[$i]['member_code']) {
						$member['total_work_time'] += 1;
					}
				}
				return $member['total_work_time'];
			}
			public function workdays($member, $listWorkTime){
				$count = count($listWorkTime);
				for ($i=0; $i < $count; $i++) { 
					if($member['code'] === $listWorkTime[$i]['member_code']){
						if ($member['has_lunch_break'] === 0 && strtotime(date('h:i:s', strtotime($listWorkTime[$i]['start_datetime']))) <= strtotime($member['start_work_time']) && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 >= $member['work_hour']) {
							$member['workdays'] += 1;
						}
						if ($member['has_lunch_break'] === 0 && strtotime(date('h:i:s', strtotime($listWorkTime[$i]['start_datetime']))) <= strtotime($member['start_work_time']) && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 > $member['work_hour']/2 && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 < $member['work_hour']) {
							$member['workdays'] += 0.5;
						}
						if ($member['has_lunch_break'] === 0 && strtotime(date('h:i:s', strtotime($listWorkTime[$i]['start_datetime']))) > strtotime($member['start_work_time']) && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 >= $member['work_hour']) {
							$member['workdays'] += 0.5;
						}
						if ($member['has_lunch_break'] === 0 && strtotime(date('h:i:s', strtotime($listWorkTime[$i]['start_datetime']))) > strtotime($member['start_work_time']) && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 > $member['work_hour']/2 && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 < $member['work_hour']) {
							$member['workdays'] += 0.5;
						}
						if ($member['has_lunch_break'] === 1 && strtotime(date('h:i:s', strtotime($listWorkTime[$i]['start_datetime']))) <= strtotime($member['start_work_time']) && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 >= $member['work_hour'] + 1.5) {
							$member['workdays'] += 1;
						}
						if ($member['has_lunch_break'] === 1 && strtotime(date('h:i:s', strtotime($listWorkTime[$i]['start_datetime']))) <= strtotime($member['start_work_time']) && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 > ($member['work_hour']/2) + 1.5 && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 < $member['work_hour'] + 1.5) {
							$member['workdays'] += 0.5;
						}
						if ($member['has_lunch_break'] === 1 && strtotime(date('h:i:s', strtotime($listWorkTime[$i]['start_datetime']))) > strtotime($member['start_work_time']) && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 >= $member['work_hour'] + 1.5) {
							$member['workdays'] += 0.5;
						}
						if ($member['has_lunch_break'] === 1 && strtotime(date('h:i:s', strtotime($listWorkTime[$i]['start_datetime']))) > strtotime($member['start_work_time']) && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 > ($member['work_hour']/2) + 1.5 && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 < $member['work_hour'] + 1.5) {
							$member['workdays'] += 0.5;
						}
					}
				}
				return $member['workdays'];
			}
			public function workdaysOfMonth($m, $y){
				$daysOfMonth = date("t",mktime(0,0,0,$m,1,$y));
				$workdaysOfMonth = 0;
				for ($d=1; $d <= $daysOfMonth; $d++) { 
					$weekday = date("w",mktime(0,0,0,$m,$d,$y));
					if ($weekday > 0 && $weekday < 6) {
						$workdaysOfMonth += 1;
					}
				}
				switch ($m) {
					case 1:
					case 3:
					case 4:
					case 5:
							$workdaysOfMonth -= 1;
						break;
					case 2:
							$workdaysOfMonth -= 5;
						break;
					case 9:
							$workdaysOfMonth -= 2;
						break;
				}
				return $workdaysOfMonth;
			}
		}
		$managerMF = [];
		foreach ($listMemberFullTime as $member) {
		 	$managerMF[] = new Member($member['code'], $member['full_name'], $member['age'], $member['gender'], $member['marital_status'], $member['salary'], $member['start_work_time'], $member['work_hour'], $member['has_lunch_break']);
		}
		$managerMP = [];
		foreach ($listMemberPartTime as $member) {
		 	$managerMP[] = new Member($member['code'], $member['full_name'], $member['age'], $member['gender'], $member['marital_status'], $member['salary'], $member['start_work_time'], $member['work_hour'], $member['has_lunch_break']);
		}
		$y = (int)substr($listWorkTime[0]['start_datetime'], 0, 4);
		$m = (int)substr($listWorkTime[0]['start_datetime'], 5, 2);
		$calculate = new Calculate();
		$workdaysOfMonth = $calculate->workdaysOfMonth($m, $y);
		$count1 = count($managerMF);
		for ($i = 0; $i < $count1; $i++) {
			$managerMF[$i]->setTotalWorkTime($calculate->totalWorkTime($listMemberFullTime[$i], $listWorkTime));
			$managerMF[$i]->setWorkdays($calculate->workdays($listMemberFullTime[$i], $listWorkTime));
		}
		$count2 = count($managerMP);
		for ($i = 0; $i < $count2; $i++) {
			$managerMP[$i]->setTotalWorkTime($calculate->totalWorkTime($listMemberPartTime[$i], $listWorkTime));
			$managerMP[$i]->setWorkdays($calculate->workdays($listMemberPartTime[$i], $listWorkTime));
		}
		if (isset($_POST['member'])) {
			foreach ($managerMF as $key => $value) {
				echo 'Id: '.$value->getCode().'<br/>';
				echo 'Name: '.$value->getName().'<br/>';
				echo 'Age: '.$value->getAge().'<br/>';
				if ($value->getGender() === 0) {
					echo 'Gender: Male'.'<br/>';
				}
				else echo 'Gender: Female'.'<br/>';  
				if ($value->getMarital() === 0) {
					echo 'Marital: Not married'.'<br/>';
				}
				else echo 'Marital: Married'.'<br/>';
				echo 'Total work time: '.$value->getTotalWorkTime().' days'.'<br/>';
				echo 'Salary: '.$value->getSalary().' vnd'.'<br/>';
				echo 'Salary of this month: '.(int)($value->getSalary()*$value->getWorkdays()/$workdaysOfMonth).' vnd'.'<br/>';
				echo 'Workdays: '.$value->getWorkdays().'<br/>';
				echo 'Start work time: '.$value->getStartWorkTime().'<br/>';
				echo 'Work hour: '.$value->getWorkHour().'h'.'<br/>';
				if ($value->getHasLunchBreak() === 0) {
					echo 'Has Lunch Break: No'.'<br/>';
				}
				else echo 'Has Lunch Break: Yes'.'<br/>';
				echo 'Worrking mode: Fulltime'.'<br/>';
				echo '<br/>';
			}
			foreach ($managerMP as $key => $value) {
				echo 'Id: '.$value->getCode().'<br/>';
				echo 'Name: '.$value->getName().'<br/>';
				echo 'Age: '.$value->getAge().'<br/>';
				if ($value->getGender() === 0) {
					echo 'Gender: Male'.'<br/>';
				}
				else echo 'Gender: Female'.'<br/>';  
				if ($value->getMarital() === 0) {
					echo 'Marital: Not married'.'<br/>';
				}
				else echo 'Marital: Married'.'<br/>';
				echo 'Total work time: '.$value->getTotalWorkTime().' days'.'<br/>';
				echo 'Salary: '.$value->getSalary().' vnd'.'<br/>';
				echo 'Salary of this month: '.(int)($value->getSalary()*$value->getWorkdays()/$workdaysOfMonth).' vnd'.'<br/>';
				echo 'Workdays: '.$value->getWorkdays().'<br/>';
				echo 'Start work time: '.$value->getStartWorkTime().'<br/>';
				echo 'Work hour: '.$value->getWorkHour().'h'.'<br/>';
				if ($value->getHasLunchBreak() === 0) {
					echo 'Has Lunch Break: No'.'<br/>';
				}
				else echo 'Has Lunch Break: Yes'.'<br/>';
				echo 'Worrking mode: Parttime'.'<br/>';
				echo '<br/>';
			}
		}
		if (isset($_POST['findMember'])) {
			$input = $_POST['input'];
			foreach (array_merge($managerMF, $managerMP) as $key => $value) {
				if ($value->getCode() == $input || $value->getName() == $input) {
					echo 'Id: '.$value->getCode().'<br/>';
					echo 'Name: '.$value->getName().'<br/>';
					echo 'Age: '.$value->getAge().'<br/>';
					if ($value->getGender() === 0) {
						echo 'Gender: Male'.'<br/>';
					}
					else echo 'Gender: Female'.'<br/>';  
					if ($value->getMarital() === 0) {
						echo 'Marital: Not married'.'<br/>';
					}
					else echo 'Marital: Married'.'<br/>';
					echo 'Total work time: '.$value->getTotalWorkTime().' days'.'<br/>';
					echo 'Salary: '.$value->getSalary().' vnd'.'<br/>';
					echo 'Salary of this month: '.(int)($value->getSalary()*$value->getWorkdays()/$workdaysOfMonth).' vnd'.'<br/>';
					echo 'Workdays: '.$value->getWorkdays().'<br/>';
					echo 'Start work time: '.$value->getStartWorkTime().'<br/>';
					echo 'Work hour: '.$value->getWorkHour().'h'.'<br/>';
					if ($value->getHasLunchBreak() === 0) {
						echo 'Has Lunch Break: No'.'<br/>';
					}
					else echo 'Has Lunch Break: Yes'.'<br/>';
					if (in_array($value, $managerMF)) {
						echo 'Worrking mode: Fulltime'.'<br/>';
					}
					else echo 'Worrking mode: Parttime'.'<br/>';
					echo '<br/>';
				}
			}
		}
	?>
</body>
</html>