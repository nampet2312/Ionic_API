<?php
class DatabaseConnection {                    //เป็นการสร้างคลาสใน php เป็นคลาสที่ไม่มีการสืบทอด
	private $host = "localhost";
	private $db_name = "test"; //3-7 คือการสร้างตัวแปร   
	private $username = "root";
	private $password = "23122540";
	public $conn;                      //เป็นตัวสำหรับเก็บค่าการเชื่อมต่อ

	public function getConnection(){    //เมทธอต ทำหน้าที่เชื่อมต่อกับฐานข้อมูล
		$this->conn = null;             //ชี้ไปยังตัวแปร conn โดยกำหนดค่าเริ่มต้นเป็นค่า null ตัวแปรรเก็บค่าการเชื่อมต่อ
		
		try { //try catch ดักเออเร่อ
			$this->conn = new PDO ("mysql:host=" . $this->host . ";dbname=" . //13-14 คำสั่งที่ใช้ในการเชื่อมต่อข้อมูล ชี้ไปยังตัวแปร
									$this->db_name, $this->username, $this->password);
			$this->conn->exec("set names utf8");                 //เมทธอตในการประมวลผล 
		}catch(PDOException $exception){                        //ดักจับเออเร่อ
			echo "Connection error: " . $exception->getMessage();  ///การแสดงผลลัพธ์ ข้อมูลออกมา  เชื่อมข้อความ. $exception->getMessage
		}

		return $this->conn;     //รีเทินค่า 
	}
}
?>
