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
			$arr_input_1 = explode(',', $input);
			$count = count($arr_input_1);
			for ($i=0; $i < $count; $i++) { 
				$arr_input_2 = explode('-', $arr_input_1[$i]);
				if(!is_numeric($arr_input_2[0]) || !is_numeric($arr_input_2[1])){
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
			$arr_input_1 = explode(',', $input);
			$count = count($arr_input_1);
			for ($i=0; $i < $count; $i++) { 
				$arr_input_2 = explode('-', $arr_input_1[$i]);
				$min = min($arr_input_2);
				$max = max($arr_input_2);
				$arr_result = [];
				for($j = $min; $j <= $max; $j++){
					if(check($j)){
						array_push($arr_result, $j);
					}
				}
			}
			return $arr_result;
		}
		function main(){
			if(isset($_POST['submit'])){
				$input = $_POST['input'];
				$validate_input = validate($input);
				if($validate_input['code'] === 0){
					echo $validate_input['message'];
				}
				$arr_result = (processing($input));
				$count = count($arr_result);
				for($i = 0; $i < $count; $i++){
					echo $arr_result[$i].'</br>';
				}
			}
		}
		main();
	?>
</body>
</html>