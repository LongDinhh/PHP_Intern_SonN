<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		A:<input type="text" name="a"><br/>
		A:<input type="text" name="b"><br/>
		A:<input type="text" name="c"><br/>
		<input type="submit" name="kq" value="Kết quả">	
	</form>
	<?php
	function validate($a, $b, $c){
	if (!is_numeric($a)) {
		return [
			'message' => 'A không phải số',
			'code' => 0
		];
	}
	if (!is_numeric($b)) {
		return [
			'message' => 'B không phải số',
			'code' => 0
		];
	}
	if (!is_numeric($c)) {
		return [
			'message' => 'C không phải số',
			'code' => 0
		];
	}
	}
	function giaiPtb2($a, $b, $c){
	if($a === 0){
		$nghiem = (-$c)/$b;
		return [
				'code' => 1,
				'x1' => $nghiem,
				'x2' => null
		];
	}
	if($a !== 0){
		$delta = $b*$b - 4*$a*$c;
		if($delta < 0){
			return [
				'code' => 0,
				'x1' => null,
				'x2' => null
			];
		}
		if($delta === 0){
			$nghiem = (-$b)/(2*$a);
			return [
				'code' => 1,
				'x1' => $nghiem,
				'x2' => $nghiem
			];
		}
		if($delta > 0){
			$nghiem1 = ((-$b)+sqrt($delta))/(2*$a);
			$nghiem2 = ((-$b)-sqrt($delta))/(2*$a);
			return [
				'code' => 1,
				'x1' => $nghiem1,
				'x2' => $nghiem2
			];
		}		
	}
	}
	function main(){
	$a = $_POST['a'];
	$b = $_POST['b'];
	$c = $_POST['c'];
	$s = validate($a, $b, $c);
	if($s['code'] === 0){
		echo $s['message'];
	}
	print_r(giaiPtb2($a, $b, $c));
	}
	main();
	?>
</body>
</html>
