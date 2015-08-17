<?php
	class Log{
		public $filename;
		public $handle;
		public function __construct($prefix = 'log')
		 {
			$date = date("Y-m-d");
			$this->filename = "../logInfo/{$prefix}-{$date}.log";
			//open filename for appending
			//pointer assigned to $handle
		    $this->handle = fopen($this->filename, 'a');
		 }
		public function logMessage($logLevel, $message)
		{
			$date = date("Y-m-d");
			$time = date("h:i:sa");
			$log = "$date $time";
		    fwrite($this->handle, PHP_EOL . "$log $logLevel: $message");
		}
		public function info($message){
			$this->logMessage("INFO", $message);
		}
		public function error($message){
			$this->logMessage("ERROR", $message);
		}
		public function __destruct()
		{
		    fclose($this->handle);
		}
	}
?>