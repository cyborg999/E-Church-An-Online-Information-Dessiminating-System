<?php
error_reporting(0);

class Model {
	protected $db;
	public $errors = array();

	function op($data){
		echo "<pre>";
		print_r($data);
	}

	function opd($data){
		op($data);
		die();
	}

	public function _isCurl(){
	    return function_exists('curl_version');
	}

	public function __construct(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// $this->testMsg();
		// die();
		$curlEnabled = $this->_isCurl();

		if($curlEnabled == false){
			echo "Please enable the 'curl' setting in order to use the Chikka API";
			die();
		}

		$server 	= "localhost";
		$db 		= "echurch";
		$username 	= "root";
		$charset 	= "utf8";
		$password 	= "";

		$db = new PDO("mysql:host=$server;dbname=$db;charset=$charset", $username, $password);

		$this->db = $db;

		$x = $this->getAllActiveLineman();
	
		$this->registrationListener();
		$this->loginUserListener();
		$this->addAnnouncementListener();
		$this->loadAnnouncementListener();
		$this->updateStudentInfoListener();
		$this->loadProfileListener();
		$this->restrictAccess();
		$this->loadFilesListener();
		$this->loadLinemanListener();
		$this->addEventListener();
		$this->loadEventListener();
		$this->logout();
		$this->complaintListener();
		$this->complaintListListener();
		$this->exportListener();
		$this->getComplaintListListener();
		$this->addSupplyListener();
		$this->updateSupplyListener();
		$this->deactivateUserListener();
		$this->updateSettingListener();
		$this->addSlidesListener();
		$this->getSetting();
		$this->deleteSlide();
		$this->addNatureListener();
		$this->deleteNatureListener();
		$this->addApplicationListener();
		$this->addBranchListener();
		$this->updateRequirementsListener();
		$this->searchApplicant();
		$this->updateMyRequirementsListener();
		$this->addMaterialListener();
		$this->updateMaterialListener();
		$this->searchMaterial();
		$this->completeRequirementListener();
		$this->editNatureListener();
		$this->searchEmailListener();
		$this->generateReportListener();
		$this->sendSmsListener();
		$this->updateBranchListener();
		$this->getMyScheduleListener();
		$this->updateUserListener();
		$this->addBrgyListener();
		$this->sendMessageListener();
		$this->deleteNewsListener();
		$this->viewMessages();
		$this->addServiceListener();
		$this->deleteServicesListener();
		$this->updateServiceListener();
		$this->uploadImageListener();
		$this->removePreviewListener();
		$this->updateEventListener();
		$this->deleteEventListener();
		$this->approveEventListener();
		$this->updateNewsListener();
		$this->updateSlideShowListener();
		$this->deleteSpecificEventListener();
	}	

	public function deleteSpecificEventListener(){
		if(isset($_POST['deleteSpecificEvent'])){
			$stmnt = $this->db->prepare("
					DELETE FROM schedule
					WHERE id = ?
				");
			$stmnt->execute(array($_POST['id']));

			die(json_encode(array("deleted")));
		}
	}

	public function updateSlideShowListener(){
		if(isset($_POST['updateSlideShow'])){

			$stmnt = $this->db->prepare("
					UPDATE slides
					SET title = ?, `desc` = ?
					WHERE id = ?
				");
			$stmnt->execute(array($_POST['title'], $_POST['desc'], $_POST['id']));
			die(json_encode(array("updated" => true)));
		}
	}

	public function updateNewsListener(){
		if(isset($_POST['updateNews'])){
			$stmnt = $this->db->prepare("
					UPDATE announcement
					SET title = ?,
					description = ?
					WHERE id = ?
				");
			$stmnt->execute(array($_POST['title'], $_POST['desc'], $_POST['id']));

			die(json_encode(array("updated")));
		}
	}

	public function approveEventListener(){
		if(isset($_POST['approveEvent'])){
			$id = $_POST['id'];
			$message = $_POST['message'];
			$contact = $_POST['contact_number'];
			$stmnt = $this->db->prepare("
					UPDATE schedule
					SET approved = ?
					WHERE id = ?
				");

			$stmnt->execute(array($_POST['status'], $id));
			$this->sendMessage($contact, $message);

			die(json_encode(array("updated" => true)));
		}
	}

	public function getScheduleList($special = false){
		$records = array();
		$where = ($special == true) ? " WHERE t3.special != 1" : "";
		$stmnt = $this->db->prepare("
				SELECT t1.*, t2.firstname,t2.lastname,t2.contact_number,t3.title
				FROM schedule t1
				LEFT JOIN info t2
				on t1.user_id = t2.userid
				LEFT JOIN services t3
				ON t1.overview = t3.id
			".$where." ORDER BY t1.startdate desc");

		$stmnt->execute();

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function getSchedulById($id){
		$stmnt = $this->db->prepare("
				SELECT * 
				FROM schedule
				WHERE id = ?
			");
		$stmnt->execute(array($id));

		return $stmnt->fetch();
	}

	public function deleteEventListener(){
		if(isset($_POST['deleteEvent'])){
			$id = $_POST['id'];
			$schedule = $this->getSchedulById($id);
			$special = $this->getServiceById($schedule['overview']);

			if($special['special'] == 1){
				die(json_encode(array("deleted" => "failed")));
			}
						
			if( ($schedule['user_id'] == $_SESSION['user']['id']) || 
				($_SESSION['user']['type'] != "applicant")
				){
				$stmnt = $this->db->prepare("
					DELETE FROM schedule
					WHERE id = ?
				");
				$stmnt->execute(array($id));

				die(json_encode(array("deleted" => true)));
			} else {
				die(json_encode(array("deleted" => false)));
			}

			
		}
	}

	public function updateEventListener(){
		if(isset($_POST['updateEvent'])){
			$id = $_POST['id'];
			$enddate = $_POST['endDate'];
			$time = strtotime($enddate);
		    $enddate = Date('m/d/Y H:i:s', $time);

		    $stmnt = $this->db->prepare("
		    		UPDATE schedule
		    		SET enddate = ?
		    		WHERE id = ?
		    	");
		    $stmnt->execute(array($enddate, $id));

		    die(json_encode(array("updated" => true)));
		}	
	}

	public function removePreviewListener(){
		if(isset($_POST['removePreview'])){
			$stmnt = $this->db->prepare("
					DELETE FROM file
					WHERE id = ?
				");
			$stmnt->execute(array($_POST['id']));

			die(json_encode(array(true)));
		}
	}

	public function getPreviewByServiceId($id){
		$records = array();
		$stmnt =  $this->db->prepare("SELECT * FROM file WHERE service_id = ?");

		$stmnt->execute(array($id));

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function uploadImageListener(){
		if(isset($_POST['uploadImage'])){
			$stmnt = $this->db->prepare("
					INSERT INTO file 
					VALUES(NULL,?,NULL,NULL,NULL,?)
				");
			$stmnt->execute(array($_POST['link'],$_POST['id']));

			die(json_encode(array("added")));
		}
	}

	public function getRequirementsByServiceId($id, $li = false){
		$records = array();
		$list = "";
		$stmnt =  $this->db->prepare("SELECT * FROM requirement WHERE service_id = ?");

		$stmnt->execute(array($id));

		while($row = $stmnt->fetch()){
			$list .="<li>".$row['title']."</li>";
			$records[] = $row;
		}

		if($li != false){
			return $list;
		}

		return $records;
	}

	public function getServiceById($id){
		$stmnt =  $this->db->prepare("SELECT * FROM services WHERE id =? LIMIT 1");

		$stmnt->execute(array($id));

		return $stmnt->fetch();
	}

	public function updateServiceListener(){
		if(isset($_POST['updateService'])){
			$stmnt = $this->db->prepare("
					UPDATE services
					SET title = ?, description = ?
					WHERE id = ?
				");

			$stmnt->execute(array($_POST['title'], $_POST['description'], $_POST['id']));

			//delete requirement
			$stmnt = $this->db->prepare("
					DELETE FROM requirement
					WHERE service_id = ?
				");
			$stmnt->execute(array($_POST['id']));

			//add new requirement

			if(isset($_POST['requirement'])){
			$requirement = $_POST['requirement'];

				foreach($requirement as $requirement){
					$stmnt = $this->db->prepare("
							INSERT INTO requirement
							VALUES(NULL,?,?)
						");
					$stmnt->execute(array($_POST['id'],$requirement));
				}
			}
			
			// echo "<pre>";
			// [requirement] => Array
   //      (
   //          [0] => adads 
   //          [1] => dfgdfgdf 
   //      )
			// print_r($_POST);
			die(json_encode(array(true)));
		}
	}

	public function deleteServicesListener(){
		if(isset($_POST['deleteService'])){
			$stmnt = $this->db->prepare("
					SELECT *
					FROM services
					WHERE id = ?
					LIMIT 1
				");
			$stmnt->execute(array($_POST['id']));
			$special = $stmnt->fetch();
			$special = $special['special'];
			$stmnt = $this->db->prepare("
					DELETE FROM services WHERE id =?
				");

			$stmnt->execute(array($_POST['id']));

			if($special == 1){
				$stmnt = $this->db->prepare("
					DELETE FROM schedule WHERE overview =?
				");

				$stmnt->execute(array($_POST['id']));

			}
			die(json_encode(array("id" => $_POST['id'])));
		}
	}

	public function getAllServices($approved = false){
		$where = ($approved ===  true) ? "WHERE special != 1": "";
		$records = array();
		$stmnt = $this->db->prepare("SELECT * FROM services $where");
		$stmnt->execute(array());
		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function generateFixedEventDate($id){
		$endDate = strtotime("+1 year",strtotime(date("m/d/Y H:i:s")));
		// $endDate = strtotime("+2 week",strtotime(date("m/d/Y H:i:s")));
		$time = strtotime("-1 hour",strtotime(current(explode("(",$_POST['start']))));
	    $his = Date('H:i:s', $time);
	    $day = Date('l', $time);
	    $start = Date('m/d/Y H:i:s', $time);
	    $end = "";
	    $newtimestamp = strtotime("$start + 30 minute");

	    if($_POST['end'] == ""){
		    $end = Date('m/d/Y H:i:s', $newtimestamp);
	    } else {
			$end = strtotime("-1 hour",strtotime(current(explode("(",$_POST['end']))));

		    $end = Date('m/d/Y H:i:s', $end);
	    }
	   	

	   	$dStart = new DateTime($start);
		$dEnd = new DateTime($end);
		$dDiff = $dStart->diff($dEnd);
		
		
	    //insert here
	 //    $stmnt = $this->db->prepare("
		// 		INSERT INTO schedule(overview,user_id,startdate,enddate)
		// 		VALUES(?,?,?,?)
		// 	");

		// $stmnt->execute(array(
		// 		$id,
		// 		$_SESSION['user']['id'],
		// 		$start,
		// 		$end
		// 	));

		for($i = strtotime($start); $i <= $endDate; $i = strtotime('+1 week', $i)){
		   	$newStart = date('m/d/Y ', $i).$his;
		    $newEndDate ="";
		    $newEndDate = strtotime("$newStart + $dDiff->i minute");
		    $newEndDate = date("m/d/Y H:i:s", $newEndDate);
		    $newEndDate = date("m/d/Y H:i:s",strtotime("$newEndDate + $dDiff->h hour"));

		    //insert here
		    $stmnt = $this->db->prepare("
					INSERT INTO schedule(overview,user_id,startdate,enddate)
					VALUES(?,?,?,?)
				");

			$stmnt->execute(array(
					$id,
					$_SESSION['user']['id'],
					$newStart,
					$newEndDate
				));

		}
	}

	public function addServiceListener(){
		if(isset($_POST['addService'])){

			if(isset($_POST['special'])){
				$stmnt = $this->db->prepare("
					INSERT INTO services 
					VALUES(NULL,?,?,?,1)
				");

			} else {
				$stmnt = $this->db->prepare("
					INSERT INTO services 
					VALUES(NULL,?,?,?,0)
				");

			}
		
			$stmnt->execute(array($_POST['title'], $_POST['description'], date("Y-m-d",time())));
			
			$id = $this->db->lastInsertId();


	        $data = array(
		    	"id" => $id,
		    	"title" => $_POST['title'],
		    	"description" => $_POST['description']);
			
			if(isset($_POST['special'])){
				$this->generateFixedEventDate($id);
			}

			die(json_encode($data));
		}
	}

	public function deleteNewsListener(){
		if(isset($_POST['deleteNews'])){
			$stmnt = $this->db->prepare("
					DELETE FROM  announcement
					WHERE id = ?
				");

			$stmnt->execute(array($_POST['id']));

			die(json_encode(array("deleted" => true)));
		}
	}

	public function viewMessages(){
		if(isset($_POST['viewMsg'])){
			$stmnt = $this->db->query("
				SELECT id 
				FROM info
				WHERE userid = ".$_SESSION['user']['id']."
			");
	
			$stmnt->execute();
			$id = $stmnt->fetch();
			$id = $id['id'];

			$records = array();
			$stmnt = $this->db->prepare("
					SELECT t1.*,concat(t2.firstname,' ',t2.lastname) as sender 
					FROM inbox t1
					LEFT JOIN info t2
					ON T1.recipient_id = t2.id
					WHERE t1.recipient_id = ?
				");
			$stmnt->execute(array($id));

			while($row = $stmnt->fetch()){
				$records[] = $row;
				//update seen
				$this->updateInboxSeen($row['id']);
			}


			die(json_encode($records));
		}	
	}

	public function updateInboxSeen($id){
		$stmnt = $this->db->prepare("
				UPDATE inbox
				SET seen = 1
				WHERE id = ?
			");
		$stmnt->execute(array($id));
	}

	public function getMessagesCount(){
		$stmnt = $this->db->query("
				SELECT id 
				FROM info
				WHERE userid = ".$_SESSION['user']['id']."

			");
		$stmnt->execute();
		$id = $stmnt->fetch();
		
		return  $this->db
			->query("
				SELECT *
				FROM inbox 
				where recipient_id = ".$id['id']."
				AND seen = 0
				")
			->rowCount();
	}

	public function getAllRecipients(){
		$records = array();
		$stmnt 	= $this->db->prepare("
				select t2.*,t1.deleted,t1.username,t1.email,t1.status,t1.requirement,t2.consumer_type,t1.date_registered
				from info t2
				left join user t1 on t1.id = t2.userId
				WHERE t1.type !='applicant'
				AND t1.id != ?
			");
		$stmnt->execute(array($_SESSION['user']['id']));

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function sendMessageListener(){
		if(isset($_POST['sendMsg'])){
			$recipients = $_POST['recipients'];

			foreach($recipients as $idx => $r){
				$this->addToInbox($_POST['title'], $_POST['message'], $r);
			}

			die(json_encode(array("added" => true)));
		}
	}

	public function addToInbox($title, $message, $recipientId){
		$stmnt = $this->db->prepare("
				INSERT INTO inbox
				VALUES(NULL,?,?,?,?,null,?)
			");

		$stmnt->execute(array($message,$title,$recipientId,0, $_SESSION['user']['id']));
	}

	// todo: how to update once the complaint is fixed by the lineman?
	//turn error reporting off
	public function addBrgyListener(){
		if(isset($_POST['addBrgy'])){
			// echo "<pre>";
			// print_r($_POST);
			// die();	
			//check if brgy already exists for municipality
			$records = array();
			$stmnt = $this->db->prepare("
					SELECT *
					FROM brgy
					WHERE name = ?
					AND municipality = ?
					LIMIT 1
				");

			$stmnt->execute(array($_POST['brgy'], $_POST['municipality']));

			while($row = $stmnt->fetch()){
				$records[] = $row;
			}

			if(count($records) > 0){
				$this->errors[] = "Barangay already exists in this municipality.";
				$this->getErrors();
			} else {
				//insert new records
				$stmnt = $this->db->prepare("
						INSERT INTO brgy
						VALUES(NULL,?,?,?)");	

				$stmnt->execute(array($_POST['brgy'], $_POST['branchId'], $_POST['municipality']));

				die(json_encode(array("success" => true)));
			}

		}
	}

	public function getComplaintExport(){
		$records 	= array();
		$stmnt 		= $this->db->prepare("
				SELECT t1.*,t3.*
				FROM complaints t1
				LEFT JOIN schedule t2 on t1.user_id= t2.user_id
				LEFT JOIN info t3 on t2.lineman_id = t3.userid
			");
		$stmnt->execute(array());

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}
	
		return $records;
	}

	public function getAllActiveLineman(){
		$records = array();
		$stmnt   = $this->db->prepare("
				SELECT t1.id,CONCAT(t2.firstname,t2.lastname) as name FROM user t1
				left join info t2 on t1.id = t2.userid
				WHERE t1.type = ?
				AND t1.deleted = 0

			");		
		
		$stmnt->execute(array("line_man"));

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function getInfoByUserId($id){
		$stmnt 	= $this->db->prepare("
				SELECT *
				FROM info
				WHERE userid = ?
				LIMIT 1
			");

		$stmnt->execute(array($id));

		return $stmnt->fetchAll();
	}

	public function getUserByUserId($id){
		$stmnt = $this->db->prepare("
				SELECT t1.*,t1.id as 'mainId',t2.*, t3.lastname as 'sLastname', 
					t3.firstname as 'sFirstname', t3.middlename as 'sMiddlename', t3.dob as 'sDob', 
					t3.pob as 'sPob', t3.occupation as 'sOccupation'
				FROM user t1 
				LEFT JOIN info t2 on t1.id = t2.userid
				LEFT JOIN spouse t3 on t1.id = t3.userid
				WHERE t2.userid = ?
				LIMIT 1
			");
		$stmnt->execute(array($id));

		return $stmnt->fetchAll();
	}


	public function getApplicationDetailById($id){
		if(is_numeric($id)){
			//TODO: Check user access here
			$records = array();

			$records['user'] 	= $this->getApplicantById($id);
			$records['info'] 	= $this->getInfoByUserId($id);
			$records['spouse'] 	= $this->getSpouseById($id);
			return $records;
		}
	}

	public function getComplaintDetailById($id){
		$stmnt 	= $this->db->prepare("
				SELECT *
				FROM complaints
				WHERE id =?
			");
		$stmnt->execute(array($id));

		while($row = $stmnt->fetch()){
			return $row;
		}
	}

	public function getMyScheduleListener(){
		if(isset($_POST['loadMySchedule'])){
			$records 	= array();
			$stmnt 		= $this->db->prepare("
					SELECT * 
					FROM schedule
					WHERE lineman_id = ?
				");

			$stmnt->execute(array($_SESSION['user']['id']));

			while($row = $stmnt->fetch()){
				$data = array(
						'id' 	=> $row['complaint_id'],
						'title' => $row['overview'],
						'start' => $row['startdate'],
						'end' 	=> $row['enddate']);

				$records[] = $data;
			}

			die(json_encode($records));
		}
	}

	public function getUnfixedComplaint(){
		$records 	= array();
		$stmnt 		= $this->db->prepare("
				SELECT t1.* from complaints t1
				where t1.id not in(select DISTINCT(t2.complaint_id) from schedule t2)
			");

		$stmnt->execute(array());

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function getMessages(){
		include "chikkaConfig.php";
		$chikkaAPI = new ChikkaSMS($clientId, $secretKey, $shortCode);

		if($_POST){
		    if ($chikkaAPI->receiveNotifications() === null) {
		            echo "Message has not been processed.";
		        }
		    else{
		        echo "Message has been successfully processed.";
		    }

		    if($chikkaAPI->receiveNotifications() !== null){
		    	//add
		    	//change message_type to incoming
		    	//create text file here
				$this->addMessage();
			    var_dump($chikkaAPI->receiveNotifications());
		    }
		}
	}

	public function addMessage(){
		if(isset($_POST['message'])){
			$stmnt = $this->db->prepare("
					INSERT INTO message
					VALUES(	NULL,
							?,
							?,
							?,
							?,
							?,
							?,
							?, 
							0)");

			$stmnt->execute(array(
						$_POST['message_type'],
						$_POST['mobile_number'],
						$_POST['shortcode'],
						$_POST['request_id'],
						$_POST['message'],
						$_POST['timestamp'],
						"admin"));
		}

	}

	public function sendMessage($number, $message){
		$number 	= preg_replace('/0/', '63', $number, 1);
		include "chikkaConfig.php";
		
		$chikkaAPI = new ChikkaSMS($clientId,$secretKey,$shortCode);
		$response = $chikkaAPI->sendText(uniqid(), $number, $message);

		header("HTTP/1.1 " . $response->status . " " . $response->message);
		exit(0);
	}

	public function sendSmsListener(){
		if(isset($_POST['sendSms'])){
			$recipients = $_POST['recipients'];
			$message 	= $_POST['message'];

			foreach($recipients as $idx => $r){
				$this->sendMessage($r, $message);
			}

			die(json_encode(array("sent" => true)));
		}
	}

	public function updateBranchListener(){
		if(isset($_POST['upadateBranch'])){
			$stmnt = $this->db->prepare("
					UPDATE branch
					SET name = ?, municipality = ?
					WHERE id = ? ");

			$stmnt->execute(array($_POST['name'], $_POST['municipality'], $_POST['id']));

			die(json_encode(array("updated" => true)));
		}
	}

	public function getUserById($id){
		$stmnt = $this->db->prepare("
				SELECT t1.*,t1.id as 'mainId',t2.*
				FROM user t1 
				LEFT JOIN info t2 on t1.id = t2.userid
				WHERE t1.id = ?
				LIMIT 1
			");

		$stmnt->execute(array($id));

		return $stmnt->fetchAll();
	}

	public function generateReportListener(){
		if(isset($_POST['generateExport'])){
			$this->createReport($_POST['html'], $_POST['filename']);

		}
	}

	public function createReport($html, $filename){
		include_once "../mpdf/mpdf/mpdf.php";
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        
		$mpdf 		= new mPDF();

		$mpdf->SetHTMLHeader('<div style="text-align: right; font-weight: bold;"><img src="../img/logo.png" height="20" /></div><div></div>'); 
        $mpdf->SetHTMLFooter('
            <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;"><tr>
            <td width="33%"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td>
            <td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
            <td width="33%" style="text-align: right; ">Marelco</td>
            </tr></table>');


        // $stylesheet = file_get_contents('../css/bootstrap.min.css');

        // $mpdf->WriteHTML($stylesheet,1);
		// $mpdf->WriteHTML($html,2);
		$mpdf->WriteHTML($html);
		$mpdf->Output('../reports/'.$filename,'F');

		die(json_encode(array("filename" => "reports/".$filename)));
	}

	public function searchEmailListener(){
		if(isset($_POST['searchEmail'])){
			$records = array();
			$stmnt 	= $this->db->query("
					SELECT t1.id as 'mainId',t1.*,t2.firstname,t2.* FROM user t1
					LEFT JOIN info t2
					on t1.id = t2.userid
					WHERE t1.email like '%".$_POST['email']."%'
				");	

			while($row = $stmnt->fetch()){
				$row['fullname'] = $row['firstname']." ".$row['lastname'];
				$records[] = $row;
			}

			die(json_encode($records));
		}
	}

	public function editNatureListener(){
		if(isset($_POST['editNature'])){
			$stmnt = $this->db->prepare("
					UPDATE nature
					SET type = ?, name = ?, emergency_level = ?,  requirements = ?
					WHERE id = ?
				");
			$stmnt->execute(array($_POST['nature'], $_POST['name'], $_POST['emergency_level'], $_POST['requirements'],
				$_POST['id']));
			
			die(json_encode(array("updated" => true)));
		}
	}
	public function getNatureById($id){
		$stmnt = $this->db->prepare("
				SELECT *
				FROM nature
				WHERE id = ?
			");

		$stmnt->execute(array($id));

		return $stmnt->fetch();
	}

	public function getChildrenById($id){
		$records = array();
		$stmnt = $this->db->prepare("
				SELECT *
				FROM
				children
				WHERE userid = ?
			");
		
		$stmnt->execute(array($id));

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function getSpouseById($id){
		$stmnt = $this->db->prepare("
				SELECT * 
				FROM spouse
				WHERE userid = ?
				LIMIT 1
			");

		$stmnt->execute(array($id));

		return $stmnt->fetchAll();
	}

	public function getApplicantById($id){
		$stmnt = $this->db->prepare("
				SELECT *
				FROM user
				WHERE id = ?
			");
		$stmnt->execute(array($id));

		$record = $stmnt->fetchAll(PDO::FETCH_ASSOC);

		
		return $record;
	}

	public function completeRequirementListener(){
		if(isset($_POST['completeRequirement'])){
			$stmnt = $this->db->prepare("
					UPDATE user
					SET status = 3
					WHERE id = ?
				");

			$stmnt->execute(array($_POST['id']));

			die(json_encode(array(true)));
		}
	}

	public function getAllRequirementsByType($type){
		$records = array();
		$stmnt = $this->db->prepare("
				SELECT *
				FROM requirements 
				WHERE membership_type = ?
			");

		$stmnt->execute(array($type));

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function getDefaultMaterial(){
		$records = array();
		$stmnt = $this->db->query("
				SELECT *
				FROM material
				WHERE is_default = 1 
			");

		while ($row = $stmnt->fetch()) {
			$records[] = $row;
		}

		return $records;
	}

	public function searchMaterial(){
		if(isset($_POST['searchMaterial'])){
			$records = array();
			$all = $_POST['all'];

			if($all == "true"){
				$stmnt 	= $this->db->query("
					SELECT * 
					FROM material 
				");
			} else {
				$stmnt 	= $this->db->query("
					SELECT * 
					FROM material 
					WHERE description like '%".$_POST['txt']."%'
				");	
			}

			while($row = $stmnt->fetch()){
				$records[] = $row;
			}

			die(json_encode(array("materials"=>$records)));
		}
	}

	public function updateMaterialListener(){
		if(isset($_POST['updateMaterial'])){
			$stmnt = $this->db->prepare("
					UPDATE material
					SET class_code = ?,
					description = ?,
					quantity = ?,
					unit = ?,
					remarks = ?,
					is_default = ?
					WHERE id = ?
				");

			$stmnt->execute(array(
						$_POST['classCode'],
						$_POST['description'],
						$_POST['quantity'],
						$_POST['unit'],
						$_POST['remarks'],
						($_POST['checked'] == "true") ? 1 : 0,
						$_POST['id']));
			
			die(json_encode(array("added" => true)));
		}
	}

	public function addMaterialListener(){
		if(isset($_POST['addMaterial'])){
			$stmnt = $this->db->prepare("
					INSERT INTO material
					VALUES(NULL,NULL,?,?,?,?,?,?)
				");
			$stmnt->execute(array(
				$_POST['classCode'],
				$_POST['description'],
				$_POST['quantity'],
				$_POST['unit'],
				$_POST['remarks'],
				($_POST['checked'] == "true") ? 1 : 0));
			
			die(json_encode(array("added" => true)));
		}
	}

	public function searchApplicant(){
		if(isset($_POST['searchApplicant'])){
			$records = array();
			$stmnt 	= $this->db->prepare("
				select t2.*,t1.deleted,t1.username,t1.email,t1.status,t1.requirement
				from info t2
				left join user t1 on t1.id = t2.userId
				WHERE t1.type ='applicant'
				AND MATCH ( firstname, lastname,middlename ) 
                  AGAINST (?)
			");

			$stmnt->execute(array($_POST['txt']));

			while($row = $stmnt->fetch()){
				$records[] = $row;
			}

			die(json_encode(array("users"=>$records)));
		}
	}

	public function updateMyRequirementsListener(){
		if(isset($_POST['updateMyRequirements'])){
			$requirements = implode(",", $_POST['data']);

			$stmnt = $this->db->prepare("
					UPDATE user
					SET requirement  = ?
					WHERE id = ?
				");

			$stmnt->execute(array($requirements, $_POST['id']));

			if($_POST['orientation'] == "true"){
				$this->updateUserStatus($_POST['id'], 2);
			} else {
				$this->updateUserStatus($_POST['id'], 1);
			}

			die(json_encode(array("updated" => true)));
		}
	}

	public function updateUserStatus($id, $status){
		$stmnt = $this->db->prepare("
				UPDATE user
				SET status = ?
				WHERE id = ?
			");

		$stmnt->execute(array($status, $id));
	}

	public function updateRequirementsListener(){
		if(isset($_POST['updateRequirements'])){
			//delete all requirements first
			$this->db->query("DELETE FROM requirements");

			foreach($_POST['data'] as $idx => $data){
				$stmnt = $this->db->prepare("
						INSERT INTO requirements
						VALUES(NULL, ?,?,?)
					");

				$stmnt->execute(array($data[1], $data[0], $data[2]));
			}

			die(json_encode(array("added" => true)));
		}
	}

	public function getAllRequirements(){
		$records = array();
		$stmnt = $this->db->query("SELECT * FROM requirements");

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function getAllBranchMunicipality(){
		$records = array();
		$stmnt 	= $this->db->query("
				SELECT DISTINCT(municipality)
				FROM branch
			");

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function getAllBranches(){
		$records = array();
		$stmnt 	= $this->db->query("
				SELECT * 
				FROM branch
			");

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function addBranchListener(){
		if(isset($_POST['addBranch'])){
			$stmnt = $this->db->prepare("
					INSERT INTO branch
					VALUES(NULL,?,?,NULL)
				");
			$stmnt->execute(array($_POST['municipality'], $_POST['name']));

			die(json_encode(array("added" => true)));
		}
	}

	public function addApplicationListener(){
		if(isset($_POST['addApplication'])){
			$userId = $this->validateUser($_POST);

			$this->updateSystemUser($userId);

			die(json_encode(array("added" => true)));
		}	
	}

	public function addChildren($children, $parentId){
		foreach($children['c-name'] as $idx => $child){
			if($child !=""){
				if($children['c-dob'][$idx] != ""){
					$stmnt  =  $this->db->prepare("
						INSERT INTO children 
						VALUES(NULL,?,?,?)");
					$stmnt->execute(array($child, $children['c-dob'][$idx], $parentId));
				}
			}
			
		}
	}

	public function deleteNatureListener(){
		if(isset($_POST['deleteNature'])){
			$stmnt = $this->db->prepare("
					DELETE FROM nature
					WHERE id = ?
				");

			$stmnt->execute(array($_POST['id']));

			die(json_encode(array("deleted" => true)));
		}
	}

	public function getNatureByTypeAndPriority($type){
		$records = array();
		$records['Low'] = array();
		$records['Medium'] = array();
		$records['High'] = array();
		$stmnt 	= $this->db->prepare("
				SELECT * FROM nature
				WHERE type = ?
			");

		$stmnt->execute(array($type));

		while($row = $stmnt->fetch()){
			$records[$row['emergency_level']][] = $row;
		}

		return $records;
	}

	public function getNature(){
		$records = array();
		$stmnt 	= $this->db->prepare("
				SELECT * FROM nature
			");

		$stmnt->execute();

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function getNatureByType($type){
		$records = array();
		$stmnt 	= $this->db->prepare("
				SELECT * FROM nature
				WHERE type = ?
			");
		$stmnt->execute(array($type));

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function addNatureListener(){
		if(isset($_POST['addNature'])){
			$stmnt = $this->db->prepare("
					INSERT INTO nature
					VALUES(NULL,?,?,?,?)
				");

			$stmnt->execute(array($_POST['nature'],$_POST['name'],$_POST['emergency_level'],$_POST['requirements']));

			die(json_encode(array("added"=>true)));
		}
	}

	public function deleteSlide(){
		if(isset($_POST['deleteSlide'])){
			$stmnt = $this->db->prepare("DELETE FROM slides where id = ?");

			$stmnt->execute(array($_POST['id']));

			die(json_encode(array("deleted" => true)));
		}
	}

	public function getSlideshows(){
		$result = array();
		$stmnt 	= $this->db->query("SELECT * FROM slides");

		while($row = $stmnt->fetch()){
			$result[] = $row;
		}

		return $result;
	}

	public function addSlidesListener(){
		if(isset($_POST['addSlide'])){
			$slides = $_POST['slides'];

			foreach($slides as $idx => $slide){
				$stmnt = $this->db->prepare("
						INSERT INTO slides
						VALUES(NULL,?,?,?,?)
					");	

				$stmnt->execute(array($slide[1], $slide[2], date("Y-m-d H:i:s"),$slide[0]));
			}

			die(json_encode(array("added" => true)));
		}
	}

	public function getSetting(){
		return  $this->db->query("SELECT * FROM setting LIMIT 1")->fetch();
	}

	public function updateSettingListener(){
		if(isset($_POST['updateSetting'])){
			$exists = ($_POST['id'] == "null") ? 0 : 1;

			if($exists > 0){
				$stmnt = $this->db->prepare("
								UPDATE setting
								SET about = ? , mobile = ? ,
								phone = ?, fax = ? ,
								email = ? , slogan = ?
								WHERE id = ?
							");
				
				$stmnt->execute(array(trim($_POST['about']),trim($_POST['mobile']),trim($_POST['phone']),
					trim($_POST['fax']),$_POST['email'],trim($_POST['slogan']), $_POST['id']));
			} else {
				$stmnt = $this->db->prepare("
								INSERT INTO setting
								VALUES(NULL,?,?,?,?,?,?)
							");

				$stmnt->execute(array($_POST['about'],$_POST['mobile'],$_POST['phone'],$_POST['fax'],$_POST['email'],$_POST['slogan']));
			}

			die(json_encode(array("updated" => true)));
		}
	}

	public function getAllApplicants(){
		$records = array();
		$stmnt 	= $this->db->query("
				select t2.*,t1.deleted,t1.username,t1.email,t1.status,t1.requirement,t1.date_registered
				from info t2
				left join user t1 on t1.id = t2.userId
				WHERE t1.type ='applicant'
			");
		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function deactivateUserListener(){
		if(isset($_POST['updatedDeleted'])){
			$stmnt = $this->db->prepare("
					UPDATE user
					SET deleted = ?,
					 status = ?
					WHERE id = ?
				");
			$status = ($_POST['deleted'] == 1) ? 0 :1;
			$stmnt->execute(array($_POST['deleted'], $status, $_POST['id']));

			die(json_encode(array()));
		}
	}

	public function getUsersByType($type) {
		$records 	= array();
		$stmnt 		= $this->db->prepare("
				SELECT t1.*,t2.* 
				FROM user t1
				LEFT JOIN info t2 ON t1.id = t2.userid
				WHERE t1.type = ?
			");
		$stmnt->execute(array($type));

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function getAllUsers(){
		$records 	= array();
		$stmnt 		= $this->db->query("
				SELECT t1.id as 'mainId',t1.*,t2.*,t3.name as 'branch' 
				FROM user t1
				LEFT JOIN info t2 ON t1.id = t2.userid
				LEFT JOIN branch t3 ON t1.branch_id = t3.id
				WHERE t1.type != 'applicant'
				AND t1.type != 'admin'
			");

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function updateSupplyListener(){
		if(isset($_POST['updateSupply'])){
			$stmnt = $this->db->prepare("
					UPDATE supply
					SET requesting_dept = ?, purpose = ?, date = ?, work_order_ref_no = ?, requested_by = ?,
					approved_by = ?, muv_no = ?
					WHERE id = ? ");

			$stmnt->execute(array(
						$_POST['r_dept'],
						$_POST['purpose'],
						$_POST['date'],
						$_POST['ref_no'],
						$_POST['requestedBy'],
						$_POST['approvedBy'],
						$_POST['mrvNo'],
						$_POST['id']));

			//delete all materials instead of updating it one by one, then just readd

			$stmnt = $this->db->prepare("DELETE FROM material WHERE supply_id = ?");
			$stmnt->execute(array($_POST['id']));
			
			$this->addMaterials($_POST['materials'], $_POST['id']);		
				
			die(json_encode(array("updated" => true)));
		}
	}

	public function getSupplyById($id){
		$records 	= array();
		$stmnt 		= $this->db->prepare("SELECT * FROM supply WHERE id = ? LIMIT 1");
		$stmnt->execute(array($id));

		while($row = $stmnt->fetch()){
			$records['supply'] = $row;

			$s = $this->db->prepare("SELECT * FROM material WHERE supply_id = ?");
			$s->execute(array($id));

			while($row2= $s->fetch()){
				$records['materials'][] = $row2;
			} 
		}

		return $records;
	}

	public function getAllMaterial(){
		$records = array();
		$stmnt = $this->db->query("
				SELECT * FROM material
				ORDER BY is_default DESC
			");

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function getAllSupply(){
		$records 	= array();
		$stmnt 		= $this->db->query('SELECT * FROM supply');

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;

	}	

	public function addSupplyListener(){
		if(isset($_POST['addSupply'])){
			$stmnt = $this->db->prepare("
					INSERT INTO supply
					VALUES(NULL,?,?,?,?,?,?,?)
				");

			$stmnt->execute(array($_POST['r_dept'],$_POST['purpose'],$_POST['date'],$_POST['ref_no'],$_POST['requestedBy'],$_POST['approvedBy'],$_POST['mrvNo']));
        	
        	$id = $this->db->lastInsertId();

			$this->addMaterials($_POST['materials'], $id);
		}
	}

	public function addMaterials($materials, $supplyId){
		foreach($materials as $idx => $material){
			$stmnt = $this->db->prepare("
				INSERT INTO material
				VALUES(NULL,?,?,?,?,?,?,0)
			");

			$stmnt->execute(array($supplyId,$material[0],$material[1],$material[2],$material[3],$material[4]));
		}

		die(json_encode(array("added" => true)));	
	}

	public function getComplaintListListener(){
		if(isset($_POST['getComplaints'])){
			$records = array();

			$stmnt = $this->db->query("SELECT id,complaint_nature FROM complaints WHERE user_id IS NULL");
			
			while($row = $stmnt->fetch()){
				$records[] 	= $row;
			}

			die(json_encode($records));
		}
	}

	public function complaintListListener(){
		if(isset($_POST['loadComplaints'])){
			$records 	= array();
			$type 		= $_POST['type'];
			$stmnt 		= $this->db->query("
				SELECT t1.*, CONCAT(t2.firstname,' ',t2.lastname) as fullname
				FROM complaints t1
				LEFT JOIN info t2 ON t1.user_id = t2.userid
				WHERE  t1.type = '".$type."'
			");
		
			while($row = $stmnt->fetch()){
				$records[] = $row;
			}

			die(json_encode($records));
		}
	}

	public function complaintListener(){
		if(isset($_POST['complaintAdd'])){
			$this->processComplaint($_POST);
		}
	}

	public function processComplaint($data){
		$required = array("consumer_name", "address", "contact_number", "complaint_nature");

		foreach($required as $idx => $field){
			if(empty($data[$field])){
				$fieldname = ucwords(str_replace("_", " ", $field));
				$this->errors[] = $fieldname." is required";
			}
		}

		if(count($this->errors) > 0){
			die(json_encode(array('error' => $this->errors)));
		} else {
			$stmnt = $this->db->prepare("
					INSERT INTO complaints(consumer_name,address,contact_number,complaint_nature,
						complaint_datetime,action_desired,action_taken,action_datetime,user_id,dateadded,type)
					VALUES(?,?,?,?,?,?,?,?,?,?,?)
				");

			$stmnt->execute(array(
				$data['consumer_name'],
				$data['address'],
				$data['contact_number'],
				$data['complaint_nature'],
				$data['complaint_datetime'],
				$data['action_desired'],
				$data['action_taken'],
				$data['action_datetime'],
				null,
				date("Y-m-d H:i:s"),
				$data['type'],
				)
			);

			die(json_encode(array("added" => true)));
		}
	}

	public function exportListener(){
		if(isset($_GET['export'])){
			$this->export($_GET['export']);
		}
	}

	public function loadEventListener(){
		if(isset($_POST['getEvents'])){
			$records = array();
			$where = (isset($_POST['myschedule'])) ? " WHERE t1.user_id = ".$_POST['myschedule'] : "";
			$stmnt = $this->db->query("
					SELECT t1.*,t2.title,t2.special as sp
					FROM schedule t1
					LEFT JOIN services t2 
					ON t1.overview = t2.id
					".$where);	

			while($row = $stmnt->fetch()){
				$data = array(
						"id" 	 	=> $row['id'],
						"title"	 	=> $row['title'],
						"start"	 	=> $row['startdate'],
						"categoryname" => "jordan",
						"color" 	=> ($row['approved'] == 0 ) ? ($row['sp'] == 1) ? "blue": "red" : "green",
						"end"	 	=> $row['enddate']);

				$records[] = $data;
			}

			die(json_encode($records));
		}
	}

	public function addEventListener(){
		if(isset($_POST['addEvent'])){
		    $time = strtotime("-1 hour",strtotime(current(explode("(",$_POST['start']))));
		    $start = Date('m/d/Y H:i:s', $time);
		    $newtimestamp = strtotime("$start + 30 minute");
		    $end = Date('m/d/Y H:i:s', $newtimestamp);


			$stmnt = $this->db->prepare("
					INSERT INTO schedule(overview,user_id,startdate,enddate)
					VALUES(?,?,?,?)
				");

			$stmnt->execute(array(
					$_POST['eventname'],
					$_SESSION['user']['id'],
					$start,
					$end
				));
        	$id = $this->db->lastInsertId();

			die(json_encode(array("id"=>$id)));
		}
	}   
	                                
	public function loadLinemanListener(){
		if(isset($_POST['loadLineman'])){
			$records = array();
			$stmnt = $this->db->query("SELECT t1.* from info t1 LEFT JOIN user t2 on t1.userid = t2.id");

			while($row = $stmnt->fetch()){
				$records[] = $row;
			}

			die(json_encode($records));
		}
	}

	public function loadProfileListener(){
		if(isset($_POST['loadProfile'])){
			$record = array();
			$stmnt = $this->db->prepare("SELECT * FROM info WHERE userid = ? LIMIT 1");
			$stmnt->execute(array($_SESSION['user']['id']));
			
			while($row = $stmnt->fetch()){
				die(json_encode($row));
			}

		}
	}

	public function getProfile(){
		$record = array();
		$stmnt = $this->db->prepare("SELECT * FROM info WHERE userid = ? LIMIT 1");
		$stmnt->execute(array($_SESSION['user']['id']));

		while($row = $stmnt->fetch()){
			if($row['photo'] == ""){
					$row['photo'] = "img/user.png";
				} else {
					$row['photo'] = "uploads/".$row['photo'];
				}

				return $row;
			}

			return array();
	}

	public function loadFilesListener(){
		if(isset($_POST['loadFiles'])){
			$records 	= array();
			// todo:show by user role
			$stmnt 		= $this->db->query("SELECT * FROM file");

			while($row = $stmnt->fetch()){
				$records[] = $row;
				// opd($row);
			}

			die(json_encode($records));
		}
	}

	public function addFile($filename, $type, $size){
		$stmnt = $this->db->prepare("INSERT INTO file(filename,type,size,userid) VALUES(?,?,?,?)");
		$stmnt->execute(array($filename, $type, $size, 1));
	}

	public function logout(){
		if(isset($_POST['logout'])){
			session_destroy();

			die(json_encode(array("redirect")));
		}
	}

	public function restrictAccess(){
		if(isset($_POST['loadSession'])){
			$data = array();

			if(isset($_SESSION['user'])){
				$data = array(
					"id" 			=> $_SESSION['user']['id'],
					"type" 			=> strtoupper(str_replace("_", " ", $_SESSION['user']['type'])),
					"email" 		=> $_SESSION['user']['email'],
					"username" 		=> $_SESSION['user']['username'] );

			} else {
				$data = array("redirect" => "index.html");				
			}

			die(json_encode($data));
		}
	}

	public function updateSystemUser($userId){
		$fname 	= $_POST['firstname'];
		$lname 	= $_POST['lastname'];
		$mname 	= $_POST['middlename'];
		$gender = $_POST['gender'];
		$age 	= $_POST['age'];
		$dob 	= $_POST['dob'];
		$pob 	= $_POST['pob'];
		$nationality 	= $_POST['nationality'];
		$religion 	= $_POST['religion'];
		$address 	= $_POST['address'];
		// $weight 	= $_POST['weight'];
		// $height 	= $_POST['height'];
		$contact 	= $_POST['contact_number'];
		$status 	= $_POST['civil_status'];
		// $membership_type 	= $_POST['membership_type'];
		// $consumer_type 	= $_POST['consumer_type'];
		// $userId = $_POST['userid'];

		//insert blank info data if not exists
		$record = array();
		$exists = $this->db
		->query("SELECT * FROM info WHERE userid = ".$userId." LIMIT 1")
		->rowCount();

		if($exists == 0){
			$stmnt = $this->db->prepare("
				INSERT INTO info(id,userid,contact_number)
				VALUES(NULL,?,?)
				");
			$stmnt->execute(array($userId, $contact));
		}

		$stmnt = $this->db->prepare(
			"UPDATE info 
				SET firstname = ?, lastname = ?,middlename = ?,
				age = ?, sex = ?, dob = ?, religion = ?, address = ? ,
				pob = ?, contact_number = ?, civil_status = ?,
				nationality = ?
				WHERE userid = ?
			")->execute(array($fname,$lname,$mname,$age,$gender,date("Y-m-d", strtotime($dob)),
				$religion,$address,$pob,$contact,$status,$nationality, $userId));

		die(json_encode(array("status" => "Record is Updated")));
	}

	public function updateUserListener(){
		if(isset($_POST['updateUserDetail'])){
			$this->validateUser($_POST,false,true);
			$this->updateSystemUser($_POST['userid']);
		}
	}

	public function updateStudentInfoListener(){
		if(isset($_POST['updateStudentInfo'])){
			$fname 	= $_POST['firstname'];
			$lname 	= $_POST['lastname'];
			$mname 	= $_POST['middlename'];
			$gender = $_POST['gender'];
			$age = $_POST['age'];
			$dob 	= $_POST['dob'];
			$nationality 	= $_POST['nationality'];
			$religion 	= $_POST['religion'];
			$address 	= $_POST['address'];
			$weight 	= $_POST['weight'];
			$height 	= $_POST['height'];
			$userId 	= $_SESSION['user']['id'];
			
			$exists = $this->db->query("SELECT * FROM info WHERE userid = ".$userId." LIMIT 1")->fetch();

			if($exists == true){
				$stmnt = $this->db->prepare(
						"UPDATE info 
							SET firstname = ?, lastname = ?,middlename = ?,
							age = ?, sex = ?, dob = ?, religion = ?, address = ? ,
							nationality = ?, weight = ?, height = ?
							WHERE userid = ?
						")->execute(array($fname,$lname,$mname,$age,$gender,date("Y-m-d", strtotime($dob)),
							$religion,$address,$nationality,$weight,$height, $userId));

					die(json_encode(array("status" => "Record is Updated")));

			} else {
				$stmnt = $this->db->query(
				// $stmnt = (
						"INSERT INTO info
						VALUES(NULL, 
							'".$fname."',
							'".$lname."',
							'".$mname."',
							'".$age."',
							'".$gender."',
							'".date("Y-m-d",strtotime($dob))."',
							'".$religion."',
							'".$address."',
							'".$nationality."',
							'".$weight."',
							'".$height."',
							".$userId.")"
					);

				die(json_encode(array("status" => "Record is Updated")));
			}
			
		}
	}

	public function loadAnnouncementListener(){
		if(isset($_POST['loadAnnouncement'])){
			$this->getAllAnnouncement();
		}
	}

	public function addAnnouncementListener(){
		if(isset($_POST['announcement'])){
			$this->addAnnouncement($_POST);
		}
	}

	public function addAnnouncement($data){
		$this->db->prepare("
				INSERT INTO announcement(title, description,user_id)
				VALUES(?,?,?)
			")->execute(array($data['title'], $data['description'], $_SESSION['user']['id']));

		die(json_encode(array("added")));
	}

	public function getAnnouncementById($id){
		$records 	= array();
		$stmnt 		= $this->db->prepare("
			SELECT t1.*,t2.username 
			FROM announcement  t1
			LEFT JOIN  user  t2 on t1.user_id = t2.id
			WHERE t1.id =?			
			ORDER BY t1.dateadded
			LIMIT 1
			
		");

		$stmnt->execute(array($id));

		while($row = $stmnt->fetch()){
			$row['dateadded'] = date("M-d", strtotime($row['dateadded']));
			$records[] 	= $row;
		}

		return $records;
	}

	public function getLatestAnnouncement(){
		$records 	= array();
		$stmnt 		= $this->db->query("
			SELECT t1.*,t2.username 
			FROM announcement  t1
			LEFT JOIN  user  t2 on t1.user_id = t2.id
			ORDER BY t1.dateadded DESC
			LIMIT 3
		");

		while($row = $stmnt->fetch()){
			$row['dateadded'] = date("M-d", strtotime($row['dateadded']));
			$records[] 	= $row;
		}

		return $records;
	}

	public function getAllAnnouncement(){
		$records 	= array();
		$stmnt 		= $this->db->query("
			SELECT t1.*,t2.username 
			FROM announcement  t1
			LEFT JOIN  user  t2 on t1.user_id = t2.id
			ORDER BY t1.dateadded DESC
			LIMIT 20
		");

		while($row = $stmnt->fetch()){
			$row['dateadded'] = date("M-d", strtotime($row['dateadded']));
			$records[] 	= $row;
		}

		return $records;
	}

	public function loginUserListener(){
		if(isset($_POST['login'])){
			$this->getLoginUser($_POST);
		}
	}

	public function getErrors(){
		die(json_encode(array("error" => $this->errors)));
	}

	public function getLoginUser($data){
		$stmnt = $this->db
			->query("SELECT * FROM user WHERE username = '".$data['username']."' AND deleted = 0 AND password = '".md5($data['password'])."' LIMIT 1");
		
		if($stmnt->rowCount() > 0){
			foreach($stmnt as $idx => $user){
				$_SESSION['user'] = $user;
				//status
				// 0 = unverified but registered online
				// 1 = incomplete requirement
				// 2 = attended orientation

				//temporary
				die(json_encode(array("redirect" => "dashboard.php")));

					
				if($user['type'] == 'admin'){
					die(json_encode(array("redirect" => "dashboard.php")));
				}

				if($user['status'] != 0){
					die(json_encode(array("redirect" => "dashboard.php")));
				} else {
					die(json_encode(array("redirect" => "Account is not yet verified")));
				}

				// if($user['type'] == "admin"){
				// 	header("Location:adminPage.php");
				// } else {
				// 	header("Location:../index.html");
				// }

				break;
			}
		} else {
			$this->errors[] = "Invalid Account Info";
			$this->getErrors();
		}
	}

	public function registrationListener(){
		if(isset($_POST['registration'])){
			$userId = $this->validateUser($_POST);

			$this->updateSystemUser($userId);

			die(json_encode(array("added" => true)));
		}
	}

	public function isUserExists($username){
		return  $this->db
			->query("SELECT username FROM user WHERE username = '".$username."' LIMIT 1")
			->rowCount();
	}

	public function validateUser($user, $die = false, $systemUser = false){
		$contactNumber = $_POST['contact_number'];

		if(!is_numeric($contactNumber)){
			$this->errors[] = "Invalid Contact Number";
		} else {
			if(strlen($contactNumber) != 11){
				$this->errors[] = "Contact Number must consist of eleven digits number";
			} else {
				if($contactNumber[0] != "0"){
					$this->errors[] = "Contact Number must start with 0";
				}
			}
		}	

		if($systemUser == false){
			if($user['password'] != $user['password2']){
				$this->errors[] = "Passwords didn't match";
			}	

			if(strlen($user['password']) < 6){
				$this->errors[] = "Password is too short";
			}

			if($this->isUserExists($user['username']) == 1){
				$this->errors[] = "Username already exists";
			}

			if(strlen($user['username']) < 6){
				$this->errors[] = "Username is too short";
			}
		}

		if(count($this->errors) > 0){
			$this->getErrors();
		} else {
			if($die == false){
				return $this->addUser($user);
			}
		}
	}

	public function addUser($data){
		$stmnt = $this->db->prepare("
			INSERT INTO user(username,password,email,type,branch_id,status) 
			VALUES (?,?,?,?,?,?)
			");
		$status = (isset($data['status'])) ? 1 : 0;
		$stmnt->execute(array(
					$data['username'], 
					md5($data['password']), 
					$data['email'], 
					$data['type'], 
					(isset( $data['branch']) ?  $data['branch'] : null),
					$status
				)
			);

    	return  $this->db->lastInsertId();

		// if($die != true){
		// 	// die(json_encode(array("added" => true)));
		// } else {
  //       	return  $this->db->lastInsertId();
		// }
	}
}


