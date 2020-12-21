<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		Input: <input type="text" name="input"><br/>
		<input type="submit" name="create" value="Creat Array">
		<input type="submit" name="devide" value="Devide Array">
	</form>
	<?php session_start();
		function validate($input){
			if(is_numeric($input)){
				if($input > 0 && $input < 27){
					return 1;
				}
				else {
					return 0;
				}
			}
			return 0;
		}
		function createArray($input){
			$arrMain = [];
			for($i = 0; $i < $input; $i++){
				$randDataType = rand(0, 1);
				if($randDataType === 0){
					array_push($arrMain, randomInt($input));
				}
				else{
					array_push($arrMain, randomString($input));
				}
			}
			return $arrMain;
		}
		function randomInt($input): int{
			$int = '0123456789';
			$randInt = '';
			$lengthInt = rand($input/4, 3*$input/4);
			for($i = 0; $i < $lengthInt; $i++){
        		$randInt.=$int[rand(0, strlen($int)-1)];
        	}
        	$randInt = (int)$randInt;
			return $randInt;
		}
		function randomString($input): string{
			$char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        	$randString = '';
        	$lengthString = rand($input/4, 3*$input/4);
        	for($i = 0; $i < $lengthString; $i++){
        		$randString.=$char[rand(0, strlen($char)-1)];
        	}
        	return $randString;
		}
		function devideArray($arrMain){
			$arrInt = [];
			$arrString = [];
			for($i = 0; $i < count($arrMain); $i++){
				if(is_numeric($arrMain[$i])){
					array_push($arrInt, $arrMain[$i]);
				}
				else{
					array_push($arrString, $arrMain[$i]);
				}
			}
			$arrIntString = array($arrInt, $arrString);
			return $arrIntString;
		}
		function main(){
			if(isset($_POST['create'])){
				$input = $_POST['input'];
				$validateInput = validate($input);
				if($validateInput === 1){
					$input = (int)$input;
					$arrMain = createArray($input);
					echo "<pre>";
					print_r($arrMain);
					$_SESSION['arrMain'] = $arrMain;
				}
			}
			if(isset($_POST['devide'])){
				if(isset($_SESSION['arrMain'])){
					$arrIntString = devideArray($_SESSION['arrMain']);
					echo "<pre>";
					print_r($arrIntString[0]);
					echo "<pre>";
					print_r($arrIntString[1]);
				}
			}
		}
		main();
	?>
</body>
</html>