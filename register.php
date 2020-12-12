<HTML>
<head>
        <title>Registration finished</title>
    </head>
<body>
    <h1>Registration is finished.</h1>
<?php
$loginID = $_POST["id"];
$role = $_POST["role"];
$password = $_POST["pw"];
$nickname = $_POST["name"];
$email = $_POST["email"];
//$proPic = $_POST["proPic"];


	

//$image = $_FILES['img']['tmp_name'];
//$img = file_get_contents($image);

//$course = $_POST["course_number"];

//fetch the profile picture
 include "mysql-connect.php";
 $connect = mysqli_connect($server, $user, $pw, $db);
//check whether teacher or student
//insert into database
// $RandomNum   = time();
// $output_dir = "upload/";/* Path for file upload */
// 	$ImageName      = str_replace(' ','-',strtolower($_FILES['image']['name'][0]));
// 	$ImageType      = $_FILES['image']['type'][0];
 
// 	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
// 	$ImageExt       = str_replace('.','',$ImageExt);
// 	$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
// 	$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
//     $ret[$NewImageName]= $output_dir.$NewImageName;

//     /* Try to create the directory if it does not exist */
// 	if (!file_exists($output_dir))
// 	{
// 		@mkdir($output_dir, 0777);
// 	}               

// move_uploaded_file($_FILES['image']["tmp_name"][0],$output_dir."/".$NewImageName );
// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}



if ($role == "teacher"){
   // echo "teacher";
    $course = $_POST["course"];

    // $sql = "INSERT INTO personnel (empID,firstName,lastName,jobTitle,hourlyWage) VALUES ('$empID', '$firstName', '$lastName', '$jobTitle', '$hourlyWage')";

    $sql = "INSERT INTO teacher (loginID, Userpassword, NickName, Email,  Course, Role_of_user, ProfileImage) VALUES ('$loginID','$password','$nickname','$email','$course','$role', '".$fileName."')";

    mysqli_query($connect,$sql);

   if ($connect->query($sql) === TRUE){
         {
            echo "New record created successfully";
          } 
        }
    else
    {
     echo "Error: " . $sql . "<br>" . $connect->error;
   }  
          
}
else if ($role == "student"){
    echo "student";
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];
    $sql = "INSERT INTO students (loginID, Userpassword, NickName, Email, Gender, Birthday, Role_user, ProfileImage) VALUES ('$loginID','$password','$nickname','$email','$gender','$birthday','$role', '".$fileName."')";
    mysqli_query($connect,$sql);
    if ($connect->query($sql) === TRUE){
        {
           echo "New record created successfully";
         } 
       }
   else
   {
    echo "Error: " . $sql . "<br>" . $connect->error;
  }  
}



?>
</body>
</HTML> 

