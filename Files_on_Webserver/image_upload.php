<?php
 

require_once 'DbConnect.php';

// Path to move uploaded files
$target_path = "images/";
 
// array for final json respone
$response = array();
 
// getting server ip address
$server_ip = gethostbyname(gethostname());
 
// final file url that is being uploaded
$file_upload_url = 'http://' . $server_ip . '/' . 'FaceRec' . '/' . $target_path;
 
 
if (isset($_FILES['image']['name'])) {
    $target_path = $target_path . 'testimage.jpg';
 
    // reading other post parameters
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $website = isset($_POST['website']) ? $_POST['website'] : '';
 
    $response['file_name'] = basename($_FILES['image']['name']);
    
 
    try {
        // Throws exception incase file is not being moved
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            // make error flag true
            $response['error'] = true;
            $response['message'] = 'Could not move the file!';
        }
 
	$command = "python process.py";
	error_reporting(E_ALL);
	exec($command,$output);
	$data = explode(",", $output[0]);
	$response['data']

	if($data[0] != -1) {
		$sql = "SELECT * FROM users WHERE uid = $data[0]";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    	$row = $result->fetch_assoc();
			$response['output'] = $row;
			$response['isuser'] = true;
			$sql = "SELECT * FROM crimes WHERE uid = $data[0]";
			$result = $conn->query($sql);
				

			if ($stmt = mysqli_prepare($conn, $sql)) {
	    			mysqli_stmt_execute($stmt);

		   		/* bind variables to prepared statement */
		    		mysqli_stmt_bind_result($stmt, $cid, $uid, $title, $discription);

		    		/* fetch values */
			    	while (mysqli_stmt_fetch($stmt)) {
					$crime[] = array(
						'cid'=>$cid,
						'uid'=>$uid,
						'title'=>$title,
						'discription'=>$discription
					);
			    	}

			    	/* close statement */
			    	mysqli_stmt_close($stmt);

		    		// output data of each row

				$response['crimes'] = $crime;
				$response['iscrime'] = true;
			} else {
		    		$response['crimes'] = "no data found in database";
				$response['iscrime'] = false;
			}
		} else {
		    $response['output'] = "no data found in database";
		    $response['isuser'] = false;
		}
		$conn->close();

	} else {
		$response['output'] = "no data found in database";
		$response['isuser'] = false;
	}

        // File successfully uploaded

        $response['message'] = 'File uploaded successfully!';
        $response['error'] = false;
	$response['data'] = $data[0];
        $response['file_path'] = $file_upload_url . basename($_FILES['image']['name']);
    } catch (Exception $e) {
        // Exception occurred. Make error flag true
        $response['error'] = true;
        $response['message'] = $e->getMessage();
    }
} else {
    // File parameter is missing
    $response['error'] = true;
    $response['message'] = 'Not received any file!F';
}

// Echo final json response to client
echo json_encode($response);
?>
