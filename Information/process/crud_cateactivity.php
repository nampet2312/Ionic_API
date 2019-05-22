<?php 
	
	date_default_timezone_set("Asia/Bangkok"); //เชคเวลาให้เป็นแบบAsia
	
	header("Access-Control-Allow-Origin: *");     //5-9 อนุญาตให้เข้าถึงข้อมูลต่างๆได้
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
	header("Access-Control-Allow-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include "../config/DbConnect.php"; //11-12 เรียกไฟล์อื่นเข้ามาใช้ในไฟล์นี้
	include "../config/HCExec.php";
	
	$db = new DatabaseConnection();  //สร้างออฟเจคใหม่ของคลาส
	$strConn = $db->getConnection();   //เรียกเมทธอต getConnection มาเก็บไว้ใน $strConn
	$strExe = new HCExec($strConn);    //เป็นการสร้างออฟเจคของคลาส  ส่งตัวแปรการเชื่อมต่อ $strConn ให้กับคลาส HCExec

	
	//if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // get post body content
	$content = file_get_contents('php://input');
    // parse JSON
	$data = json_decode($content, true);

	//รับค่าไปเก็บที่ตัวแปล
	$action = $data['cmd'];
	$name = $data['name'];
	$lname = $data['lname'];
	$gender = $data['gender'];
	$id = $data['id'];
	
	/*
	$action = $_GET['cmd'];
	$name = $_GET['name'];
	$lname = $_GET['lname'];
	$gender = $_GET['gender'];
	$id = $_GET['id'];*/

	switch($action){//รับค่า้พื่อเลือกฟังชันการทำงาน
	case 'select' :
	$sql = " SELECT * FROM personal "; //
	$stmt = $strExe->process($sql);      //ส่งค่า sql ไปให้ฟังชัน process
	$rowCount = $stmt->rowCount();
	
	if ($rowCount > 0) {//เช็คว่ามีข้อมูลหรือป่าว
		$data_arr['rs'] = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			array_push($data_arr["rs"], $row);//ถ้ามีข้อมูลดึงข้อมูลมาแสดง
		}
		echo json_encode($data_arr);
		
		} else {
		echo json_encode(array("message" => "No data found","row"=> $rowCount));//ถ้าไม่ข้อมูลให้แสดง message
	}
	break;
	case 'selectone' :
	$sql = " SELECT * FROM personal WHERE id = '".$id."' "; //
	$stmt = $strExe->process($sql);      //ส่งค่า sql ไปให้ฟังชัน process
	$rowCount = $stmt->rowCount();
	
	if ($rowCount > 0) {//เช็คว่ามีข้อมูลหรือป่าว
		$data_arr['rs'] = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			array_push($data_arr["rs"], $row);//ถ้ามีข้อมูลดึงข้อมูลมาแสดง
		}
		echo json_encode($data_arr);
		
		} else {
		echo json_encode(array("message" => "No data found","row"=> $rowCount));//ถ้าไม่ข้อมูลให้แสดง message
	}
	break;
	case 'insert' :
	$sql = " INSERT INTO personal(name,lname,gender) VALUE ('".$name."','".$lname."','".$gender."') ";
    $stmt = $strExe->process($sql);//54-55 ส่งค่าในตัวแปร sql ไปที่ฟังชัน process
    if($stmt){
        echo json_encode(array('msg'=>'บันทึกข้อมูลเรียบร้อยแล้ว')); 
    }else{
        echo json_encode(array('msg'=>'ไม่สามารถบันทึกข้อมูลได้'));
    }

	break;
	case 'edit' :
	$sql = " UPDATE personal SET name = '".$name."', lname = '".$lname."',gender ='".$gender."' WHERE id ='".$id."' ";

    $stmt = $strExe->process($sql);
    if($stmt){
        echo json_encode(array('msg'=>'แก้ไขข้อมูลเรียบร้อยแล้ว'));
    }else{
        echo json_encode(array('msg'=>'ไม่สามารถแก้ไขข้อมูลได้'));
    }

	break;

	case 'delete' :
	$sql = " DELETE FROM personal  WHERE id ='".$id."' ";

    $stmt = $strExe->process($sql);
    if($stmt){
        echo json_encode(array('msg'=>'ลบข้อมูลเรียบร้อยแล้ว'));
    }else{
        echo json_encode(array('msg'=>'ไม่สามารถลบข้อมูลได้'));
    }

	break;
}
	//}

?>
