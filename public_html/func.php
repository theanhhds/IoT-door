<?php
	function encode($filename="", $txt, $mode)		//Write encoded text to file. If $filename doesn't exist, just return the encoded str
	{
		$toWrite = "";
		for ($i=0;$i<strlen($txt);$i++)
			$toWrite.=~$txt[$i];
		if ($filename == "") return $toWrite."\n"; 
		$f = fopen($filename, $mode);
		fwrite($f, $toWrite."\n");
		fclose($f);
	}
	
	
	function decode($filename, $lineindex=-1)	// Line index starts at 0
	{
		$read = file($filename);
		if ($lineindex != -1)
			return encode("",substr($read[$lineindex],0,strlen($read[$lineindex])-1),"");			//return 1 element in the array
		else					// means read all the file
		{
			$toReturn = "";
			foreach ($read as $r) $toReturn.= encode("",$r,"")."<br>";
		}
	}
	
	function verify($user,$pass)
	{
		$f = fopen("./data/users/".$user."/info.txt", "r");
		$p = fgets($f);
		fclose($f);
		if (password_verify($pass, $p))
			return 1;
		else
			return 0;
	}
	
	function lookup($filename, $str)		//Looking for a string in a text file
	{
		$line = file($filename);
		foreach ($line as $l)
			if (strcmp(trim((encode("",substr($l,0,strlen($l)-1),""))),$str)==0)
				return  1;					//Return 1 if found that $str
		return 0;							//Else return 0
	}
	
	function insert($filename, $str, $index)	//Insert an elements to a file. Index starts at 0
	{
		$line = file($filename);
		for ($i = sizeof($line)-1; $i >= $index; $i--)
			$line[$i+1] = $line[$i];
		$line[$index] = encode("",$str,"");
		$f = fopen($filename, "w");
		for ($i=0; $i<=sizeof($line)-1; $i++)
			fwrite($f, $line[$i]);
		fclose($f);
	}
?>