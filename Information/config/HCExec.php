<?php
/* author : prae */
class HCExec {          //ชื่อคลาส   การประมวลผล sql	

	private $conn;        //ตัวแปรใช้สำหรับการเชื่อมต่อ

	public function __construct($db){      //คอนสดักเตอร์ของคลาสแรกที่จะถูกทำงาน มีค่าพารามิตเตอร์ ($db)
		$this->conn = $db; //ให้เก็บค่า ($db) ไว้
	}
	
	public function dataTransection( $query ){ //เมทธอต dataTransection มีพารามิตเตร์ ( $query )
		try {
			$stmt = $this->conn->prepare( $query ); //$stmt
			if($stmt->execute()){  //เป็นการประมวลผล execute() เป็นเมทธอตที่ไม่มีพารามิตเตอร์
				return 1;
			} else { 
				return 0; 
			}
		} catch (PDOException $e) {
			return false;
		}
	}
	
/*	public function read( $query ){   ///ดึงข้อมูลออกมาแสดงผล
		try {
			$stmt = $this->conn->prepare( $query );
			if($stmt->execute()){
				 return $stmt;
			}
		} catch (PDOException $e) {
			return false;
		}
		}*/

		public function process($query){
			try {
				$stmt = $this->conn->prepare( $query );
				if($stmt->execute()){
					 return $stmt;
				}
			} catch (PDOException $e) {
				return false;
			}
			}
		
		
	
}
?>
