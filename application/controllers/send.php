<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Send extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> load -> model("send_model");
	}

	public function data($id, $temp) {
	    $asset_id = $this -> send_model -> get_assetid_from_meter( $id );
        echo "assetid = " . $asset_id . br(1);
        $type = $this -> send_model -> get_asset_type( $asset_id );
	    $history = $this -> send_model -> get_history($asset_id);
        $wait_time = $type['std_time'];
        echo $period = strtotime('now') - strtotime($history['time']);
        $this -> view -> p($history);
        
        $last_status = $history['status'];
        $min = $type['min_temp'];
        $max = $type['max_temp'];
        
        // Temp Abnormal
        if( $temp > $max || $temp < $min ){
        	if( isset($history)) {
        		$new_period = ( $history['abnormal_period'] + $period );
        	} else{
				$new_period = 0;
				$last_status = 'NORMAL';	
			}
			
            if( $last_status == 'NORMAL' ){
                $status = 'WAIT';
            } elseif( $last_status == 'WAIT' ){
                echo ( $new_period  ). "   " . $wait_time * 60;
                if( $new_period  >= $wait_time * 60 ){
                    $status = 'ALERT';
                }else{
                    $status = 'WAIT';;
                }    
            }elseif( $last_status == 'ALERT' ){
                $status = 'ALERT';
            }
        }else{
            $new_period = 0;
            $status = 'NORMAL';
        }
        echo $status;
        $data = array('asset_id' => $asset_id, 'temp' => $temp, 'status' => $status, 'abnormal_period' => $new_period );
		$this -> send_model -> inserttemp($data);
	}

}
