<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		Input:<input type="text" name="input"><br/>
		<input type="submit" name="submit" value="Submit">	
	</form>
	<?php
		function check($n){  
		 	for($x = 2; $x < $n; $x++){  
			  	if($n % $x ==0){  
				  	return 0;  
				}  
		   	}  
		  		return 1;  
		}
		function validate($input){
			$arrInput1 = explode(',', $input);
			$count = count($arrInput1);
			for ($i=0; $i < $count; $i++) { 
				$arrInput2 = explode('-', $arrInput1[$i]);
				if(!is_numeric($arrInput2[0]) || !is_numeric($arrInput2[1])){
					return [
					'message' => 'Nhập sai định dạng',
					'code' => 0
					];
				}
				return [
					'message' => '',
					'code' => 1
				];
			}
		}
		function processing($input){
			$arrInput1 = explode(',', $input);
			$count = count($arrInput1);
			for ($i=0; $i < $count; $i++) { 
				$arrInput2 = explode('-', $arrInput1[$i]);
				$min = min($arrInput2);
				$max = max($arrInput2);
				$arrResult = [];
				for($j = $min; $j <= $max; $j++){
					if(check($j)){
						array_push($arrResult, $j);
					}
				}
			}
			return $arrResult;
		}
		function main(){
			if(isset($_POST['submit'])){
				$input = $_POST['input'];
				$validateInput = validate($input);
				if($validateInput['code'] === 0){
					echo $validateInput['message'];
				}
				$arrResult = (processing($input));
				$count = count($arrResult);
				for($i = 0; $i < $count; $i++){
					echo $arrResult[$i].'</br>';
				}
			}
		}
		main();
	?>
</body>
</html>