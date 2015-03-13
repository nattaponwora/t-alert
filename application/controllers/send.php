<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Send extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> load -> model("send_model");
	}
	
	public function data($id1, $temp1, $id2 = null, $temp2 = null, $id3 = null, $temp3 = null) {
		$this -> load -> view('header');
		$id_array = array($id1, $id2, $id3);

		$temp_array = array($temp1, $temp2, $temp3);
		for ($i = 0; $i < 3 && $id_array[$i] != null; $i++) {
			$get_sms = $this -> send_model -> permiss($id_array[$i]);
			
			$id = $id_array[$i];
			$temp = $temp_array[$i];
			
			$asset_id = $this -> send_model -> get_assetid_from_meter($id);
			$type = $this -> send_model -> get_asset_type($asset_id);
			$adjust_value = $this -> send_model -> get_adjust_value($asset_id);
			
			$temp += $adjust_value;
			
			$history = $this -> send_model -> get_history($asset_id);
			$wait_time = $type['std_time'];

			$period = strtotime('now') - strtotime($history['time']);

			$last_status = $history['status'];
			$min = $type['min_temp'];
			$max = $type['max_temp'];

			// Temp Abnormal
			if ($temp > $max || $temp < $min) {
				if (isset($history)) {
					$new_period = ($history['abnormal_period'] + $period);
				} else {
					$new_period = 0;
					$last_status = 'NORMAL';
				}

				if ($last_status == 'NORMAL') {
					//$new_period = 0;
					$status = 'WAIT';
				} elseif ($last_status == 'WAIT') {
					//$new_period = ( $history['abnormal_period'] + $period );
					echo($new_period) . "   " . $wait_time * 60;
					if ($new_period >= $wait_time * 60) {
						$status = 'ALERT';
						if ($get_sms['get_sms'] == 1) {$this -> sms($temp, $asset_id, $type['type'], $new_period);}
					} else {
						$status = 'WAIT';
					}
				} elseif ($last_status == 'ALERT') {
					$status = 'ALERT';
				}
			} else {
				$new_period = 0;
				$status = 'NORMAL';
			}
			$data = array('asset_id' => $asset_id, 'temp' => $temp, 'status' => $status, 'abnormal_period' => $new_period);
			$this -> send_model -> inserttemp($data);
		}
		echo "suscess";
	}

	private function sms($temp, $asset_id, $type, $period) {
		$hr = floor($period / 3600);
		$min = floor($period % 3600 / 60);
		$sec = $period % 60;
		$url = "http://www.thaibulksms.com/sms_api.php";
		$username = "0830971773";
		$password = "753278";

		//$url = "http://www.thaibulksms.com/sms_api_test.php";
		//$username="thaibulksms";
		//$password="thisispassword";

		echo 1;
		$asset = $this -> send_model -> get_asset_data($asset_id);
		echo 2;
		//echo $message = "$type ({$asset['asset_shortname']}) ร้าน  {$asset['store_name']} มีอุณหภูมิ $temp เกินมาตรฐานแล้ว $hr:$min:$sec ชั่วโมง";
		echo $message = "สาขา    {$asset['store_id']} อุปกรณ์ {$asset['asset_shortname']} ผิดปกติ";
		$ScheduledDelivery = date('ymdHi', strtotime('+1 min'));
		$msisdn = $asset['tel'];
		$sender = "SMS";
		$SMStype = "premium";

		echo $data_string = "username=$username&password=$password&msisdn=$msisdn&message=$message&sender=$sender&ScheduledDelivery=$ScheduledDelivery&force=$SMStype";

		$agent = $_SERVER['HTTP_USER_AGENT'];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		$result = curl_exec($ch);
		echo "<br />";
		echo $result;

		$simple = "<para><note>simple note</note></para>";
		$p = xml_parser_create();
		xml_parse_into_struct($p, $result, $vals, $index);
		xml_parser_free($p);

		echo "Index array\n";
		echo "<pre>";
		print_r($index);
		echo "</pre><pre>";
		echo "\nVals array\n";
		print_r($vals);
		echo "</pre>";
		curl_close($ch);
	}
	
	public function is_send() {
		$this -> send_model -> get_sending();	
	}
}
