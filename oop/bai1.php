</!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		<input type="submit" name="memberFullTime" value="Member Full Time">
		<input type="submit" name="memberPartTime" value="Member Part Time">
		<input type="submit" name="salary" value="Salary">
	</form>
	<?php
		require 'Bai-1.data.php';
		class Member {
			function showProfile($count, $member){
				for ($i=0; $i < $count; $i++) { 
					echo 'Id: '.$member[$i]['code'].'<br/>';
					echo 'Full Name: '.$member[$i]['full_name'].'<br/>';
					echo 'Age: '.$member[$i]['age'].'<br/>';
					if ($member[$i]['gender'] === 0) {
						echo 'Gender: Male'.'<br/>';
					}
					else echo 'Gender: Female'.'<br/>';
					if ($member[$i]['marital_status'] === 0) {
						echo 'Marital: Married'.'<br/>';
					}
					else echo 'Marital: Not married'.'<br/>';
					echo 'Salary: '.$member[$i]['salary'].'<br/>';
					echo 'Start work time: '.$member[$i]['start_work_time'].'<br/>';
					if ($member[$i]['has_lunch_break'] === 1) {
						echo 'Has lunch break: Yes'.'<br/>';
					}
					else echo 'Has lunch break: No'.'<br/>';
					echo '<br/>';
				}
			}
		}
		class Salary {
			function timeKeeping($count1, $count2, $listWorkTime, $listMember){
				for ($i=0; $i < $count1; $i++) {
					for ($j=0; $j < $count2; $j++) { 
						if ($listWorkTime[$i]['member_code'] === $listMember[$j]['code']) {
							if (($listMember[$j]['has_lunch_break'] === 0) && (strtotime($listWorkTime[$i]['start_datetime']) <= strtotime($listMember[$j]['start_work_time'])) && ((strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 >= $listMember[$j]['work_hour'])) {
								$listMember[$j]['workdays'] += 1;
							}
							if (($listMember[$j]['has_lunch_break'] === 0) && (strtotime($listWorkTime[$i]['start_datetime']) <= strtotime($listMember[$j]['start_work_time'])) && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 >= ($listMember[$j]['work_hour'])/2 && ((strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 < $listMember[$j]['work_hour'])) {
								$listMember[$j]['workdays'] += 0.5;
							}
							if (($listMember[$j]['has_lunch_break'] === 0) && (strtotime($listWorkTime[$i]['start_datetime']) > strtotime($listMember[$j]['start_work_time'])) && ((strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 >= $listMember[$j]['work_hour'])) {
								$listMember[$j]['workdays'] += 0.5;
							}
							if (($listMember[$j]['has_lunch_break'] === 0) && (strtotime($listWorkTime[$i]['start_datetime']) > strtotime($listMember[$j]['start_work_time'])) && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 >= ($listMember[$j]['work_hour'])/2 && ((strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']))/3600 < $listMember[$j]['work_hour'])) {
								$listMember[$j]['workdays'] += 0.5;
							}
							if (($listMember[$j]['has_lunch_break'] === 1) && (strtotime($listWorkTime[$i]['start_datetime']) <= strtotime($listMember[$j]['start_work_time'])) && ((strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']) - 5400)/3600 >= $listMember[$j]['work_hour'])) {
								$listMember[$j]['workdays'] += 1;
							}
							if (($listMember[$j]['has_lunch_break'] === 1) && (strtotime($listWorkTime[$i]['start_datetime']) <= strtotime($listMember[$j]['start_work_time'])) && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']) - 5400)/3600 >= ($listMember[$j]['work_hour'])/2 && ((strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']) - 5400)/3600 < $listMember[$j]['work_hour'])) {
								$listMember[$j]['workdays'] += 0.5;
							}
							if (($listMember[$j]['has_lunch_break'] === 1) && (strtotime($listWorkTime[$i]['start_datetime']) > strtotime($listMember[$j]['start_work_time'])) && ((strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']) - 5400)/3600 >= $listMember[$j]['work_hour'])) {
								$listMember[$j]['workdays'] += 0.5;
							}
							if (($listMember[$j]['has_lunch_break'] === 1) && (strtotime($listWorkTime[$i]['start_datetime']) > strtotime($listMember[$j]['start_work_time'])) && (strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']) -5400)/3600 >= ($listMember[$j]['work_hour'])/2 && ((strtotime($listWorkTime[$i]['end_datetime']) - strtotime($listWorkTime[$i]['start_datetime']) - 5400)/3600 < $listMember[$j]['work_hour'])) {
								$listMember[$j]['workdays'] += 0.5;
							}
						}
					}
				}
				return $listMember;
			}
			function workDaysOfMonth($m, $y){
				$DaysOfMonth = date("t",mktime(0,0,0,$m,1,$y));
				$workDaysOfMonth = 0;
				for ($d=1; $d <= $DaysOfMonth; $d++) { 
					$weekday = date("w",mktime(0,0,0,$m,$d,$y));
					if ($weekday > 0 && $weekday < 6) {
						$workDaysOfMonth += 1;
					}
				}
				switch ($m) {
					case 1:
					case 3:
					case 4:
					case 5:
							$workDaysOfMonth -= 1;
						break;
					case 2:
							$workDaysOfMonth -= 5;
						break;
					case 9:
							$workDaysOfMonth -= 2;
						break;
				}
				return $workDaysOfMonth;
			}
			function showSalary($count, $listMember, $workDaysOfMonth){
				for ($i=0; $i < $count; $i++) { 
					echo 'Id: '.$listMember[$i]['code'].'</br>';
					echo 'Full Name: '.$listMember[$i]['full_name'].'</br>';
					if ($listMember[$i]['work_hour'] === 8) {
						echo 'Working Mode: Fulltime'.'</br>';
					}
					else echo 'Working Mode: Parttime'.'</br>';
					echo 'Work Days: '.$listMember[$i]['workdays'].'</br>';
					echo 'Salary: '.$listMember[$i]['salary']*$listMember[$i]['workdays']/$workDaysOfMonth.'</br>';
					echo '</br>';
				}
			}			
		}
		$count1 = count($listMemberFullTime);
		$count2 = count($listMemberPartTime);
		$count3 = count($listWorkTime);
		$listMember = array_merge($listMemberFullTime, $listMemberPartTime);
		$count4 = count($listMember);
		$member = new Member();
		if(isset($_POST['memberFullTime'])){
			$member->showProfile($count1, $listMemberFullTime);
		}
		if(isset($_POST['memberPartTime'])){
			$member->showProfile($count2, $listMemberPartTime);
		}
		if(isset($_POST['salary'])){
			$salary = new Salary();
			$timeKeeping = $salary->timeKeeping($count3, $count4, $listWorkTime, $listMember);
			$m = (int)substr($listWorkTime[0]['start_datetime'], 0, 4);
			$y = (int)substr($listWorkTime[0]['start_datetime'], 5, 2);
			$workDaysOfMonth = $salary->workDaysOfMonth($m, $y);
			$salary->showSalary($count4, $timeKeeping, $workDaysOfMonth);
		}
	?>
</body>
</html>