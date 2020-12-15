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
		function validate($a){
			$arr1 = explode(',', $a);
			for ($i=0; $i < count($arr1); $i++) { 
				$arr2 = explode('-', $arr1[$i]);
				if(!is_numeric($arr2[0]) || !is_numeric($arr2[1])){
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
		function display($a){
			$arr1 = explode(',', $a);
			for ($i=0; $i < count($arr1); $i++) { 
				$arr2 = explode('-', $arr1[$i]);
				$a1 = $arr2[0];
				$a2 = $arr2[1];
				if($a1 < $a2){
					for($j = $a1; $j <= $a2; $j++){
						if(check($j)){
							echo $j.'<br/>';
						}
					}
				}
				for($j = $a2; $j <= $a1; $j++){
					if(check($j)){
						echo $j.'<br/>';
					}
				}
			}
		}
		function main(){
			if(isset($_POST['submit'])){
				$a = $_POST['input'];
				$b = validate($a);
				if($b['code'] === 0){
					echo $b['message'];
				}
				display($a);
			}
		}
		main();
	?>
</body>
</html>