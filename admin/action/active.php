<?php
    include("db.php");
    Class Action extends Db{
        public $cn;
        public $last_id;
        function connection(){
            $this->cn=new mysqli(
                $this->db_host,
                $this->db_user,
                $this->db_pass,
                $this->db_tbl
            );
            $this->cn->set_charset("utf8");
        }
        //auto function
        function __construct(){
            $this->cn=new mysqli(
                $this->db_host,
                $this->db_user,
                $this->db_pass,
                $this->db_tbl
            );
            $this->cn->set_charset("utf8");
        } 
        //insert data
        function insert_into($tbl,$val){
            $sql="INSERT INTO $tbl VALUES($val)";
            $this->cn->query($sql);
            $this->last_id=$this->cn->insert_id;
        }
        //insert multi data
        function insert_multi_into($tbl,$val){
            $sql="INSERT INTO $tbl VALUES $val";
            $this->cn->query($sql);
            $this->last_id=$this->cn->insert_id;
        }
        //select data
        function select( $fld , $tbl , $con , $od , $s , $e , $search, $filter_field , $field , $search_val ){
            $data=array();
            if( $search== '0' ){
                $sql="SELECT $fld FROM $tbl WHERE $con ORDER BY $od LIMIT $s, $e";
            }else{
                if( $filter_field == '0' ){
                    $sql="SELECT $fld FROM $tbl WHERE $field = '$search_val' ORDER BY $od DESC LIMIT $s , $e";
                }else{
                    $sql="SELECT $fld FROM $tbl WHERE $field LIKE '%$search_val%' ORDER BY $od DESC LIMIT $s , $e";
                }
            }
            $rs=$this->cn->query($sql);
            if( $rs->num_rows > 0 ){
                while( $row= $rs->fetch_array() ){
                    $data[]=$row;
                }
                return $data;
            }else{
                return 0;
            }
        }
        //select current data
        function select_cur_data($fld,$tbl,$con){
            $sql="SELECT $fld FROM $tbl WHERE $con";
            $rs=$this->cn->query($sql);
            if( $rs->num_rows > 0 ){
                $row=$rs->fetch_array();
                return $row;
            }
            return 0;
        }
        //count data
        function count_data($tbl,$search,$fld_search,$search_fld,$search_val){
            if( $search==0 ){
                $sql="SELECT COUNT(*) AS total_data FROM $tbl";
            }else{
                if( $fld_search==0){
                    $sql="SELECT COUNT(*) AS total_data FROM $tbl WHERE ".$search_fld." = '$search_val'";
                }else if( $fld_search==1){
                    $sql="SELECT COUNT(*) AS total_data FROM $tbl WHERE ".$search_fld." LIKE '%$search_val%'";
                }
            }
            $rs=$this->cn->query($sql);
            if( $rs->num_rows > 0 ){
                $row=$rs->fetch_array();
                return $row[0];
            }else{
                return 0;
            }
        }
        //update data
        function update($tbl,$fld,$con){
            $sql="UPDATE $tbl SET $fld WHERE $con";
            $this->cn->query($sql);
        }
        // get auto id
        function auto_id($fld,$tbl,$od){
            $sql="SELECT $fld FROM $tbl ORDER BY $od LIMIT 0,1";
            $rs=$this->cn->query($sql);
            if($rs->num_rows>0){
                $row=$rs->fetch_array();
                return $row[0];
            }else{
                return 1;
            }
        }
        //check_duplicate
        function duplicate($fld,$tbl,$con){
            $sql="SELECT $fld FROM $tbl WHERE $con";
            $rs=$this->cn->query($sql);
            $num=$rs->num_rows;
            if( $num==0 ){
                return false;
            }else{
                return true;
            }
        }
        //real escape string
        function real_string($fld){
            return $this->cn->real_escape_string($fld);
        }
        //slug string
        public function slugStr($str){
            return preg_replace("#(\p{P}|\p{C}|\p{S}|\p{Z})+#u", "-", $str);
        }
        //format date
        public function get_post_date($time,$date){
			$previousTimeStamp = strtotime($time." ".$date);
			$lastTimeStamp = strtotime(date("Y-m-d h:i:sa"));
			$menos=$lastTimeStamp-$previousTimeStamp;
			$mins=$menos/60;
			if($mins<1){
			$showing= "ទើបបញ្ចូល";
			}
			else{
			$minsfinal=floor($mins);
			$secondsfinal=$menos-($minsfinal*60);
			$hours=$minsfinal/60;
			if($hours<1){
			$showing= $minsfinal . " នាទីមុន";
			}
			else{
			$hoursfinal=floor($hours);
			$minssuperfinal=$minsfinal-($hoursfinal*60);
			$days=$hoursfinal/24;
			if($days<1){
			$showing= $hoursfinal . " ម៉ោងមុន";
			}
			else if($days<2)
			{
			$showing=" ម្សិលមិញ ម៉ោង ".$time;
			}
			else{
			$d=date("d",strtotime($date));
			$m=date("m",strtotime($date));
			$y=date("Y",strtotime($date));
			if($m==1)
			{
				$m='មករា';
			}
			else if($m==2)
			{
				$m='កុម្ភៈ';			
			}
			else if($m==3)
			{
				$m='មីនា';			
			}
			else if($m==4)
			{
				$m='មេសា';			
			}
			else if($m==5)
			{
			$m='ឧសភា';			
			}
			else if($m==6)
			{
			$m='មិថុនា';			
			}
			else if($m==7)
			{
			$m='កក្តដា';			
			}
			else if($m==8)
			{
			$m='សីហា';			
			}
			else if($m==9)
			{
			$m='កញ្ញា';			
			}
			else if($m==10)
			{
			$m='តុលា';		
			}
			else if($m==11)
			{
			$m='វិច្ឆិកា';			
			}
			else if($m==12)
			{
			$m='ធ្នូ';			
			}

			$showing=$d."-".$m."-".$y ." - ម៉ោង ". $time;
			}}}
			return $showing;	
		}       

    }
?>