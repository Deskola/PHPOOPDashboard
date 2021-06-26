<?php
	include '../pagination.php';  
  	$service = new Pagination('solution');  
  	$conn = $service->dbConnect();


  	
  /////////////// //////////////////////////////////////////////
  /// //////  NEW SOLUTIONS FORM (index.php)////////////////////////////
  /// ////////////////////////////////////////////////  

  if (isset($_POST['new_solution'])) {
      $title = mysqli_escape_string($conn, $_POST['title']);
      $subserviceid = mysqli_escape_string($conn, $_POST['subservice_name']);
      $problemDesc = mysqli_escape_string($conn, $_POST['description']);
      $solution = mysqli_escape_string($conn, $_POST['solution']);
      $ref = mysqli_escape_string($conn, $_POST['referenceNumber']);

      $targetDir = "../../uploads/";
      $allowTypes = array('jpg','png','jpeg','gif');
      $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 

      $fileNames = array_filter($_FILES['files']['name']);      

      if(!empty($fileNames)){ 
        //save solution to db
        $status = '1';

        $results = $service->createSolution($title, $subserviceid, $problemDesc,$solution,$ref);

        if ($results) {
          $newSolnId = $service->getSolutionID($ref);

            foreach($_FILES['files']['name'] as $key=>$val){ 
              // File upload path 
              $fileName = basename($_FILES['files']['name'][$key]);

              $fileExt = explode('.', $fileName);
              $fileActExt = strtolower(end($fileExt));         
              
             
              if(in_array($fileActExt, $allowTypes)){                  

                  $fileNewName = uniqid('',true).".".$fileActExt;
                  
                  $fileDestination = '../../uploads/'.$fileNewName;

                  // Upload file to server 
                  if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $fileDestination)){ 
                      // Image db insert sql 
                      $insertValuesSQL .= "('".$fileNewName."','".$newSolnId['id']."','".$status."','".$ref."' ),"; 
                  }else{ 
                      $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                  } 
              }else{ 
                  $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
              } 
            }

            // Error message 
            $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
            $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
            $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
             
            if(!empty($insertValuesSQL)){ 
                $insertValuesSQL = trim($insertValuesSQL, ','); 
                // Insert image file name into database 
                $insert = $service->storeImages($insertValuesSQL); 
                if($insert){ 
                    $statusMsg = "Files are uploaded successfully.".$errorMsg;                    
                    $url = "Location: ../../index.php?successmsg=$statusMsg";
                    redirectWithMsag($url);                   

                }else{ 
                    $statusMsg = "Sorry, there was an error uploading your file.";                    
                    $url = "Location: ../../index.php?errmsg=$statusMsg";
                    redirectWithMsag($url); 
                } 
            }else{ 
                $statusMsg = "Upload failed! ".$errorMsg;                
                $url = "Location: ../../index.php?errmsg=$statusMsg";
                redirectWithMsag($url);
            } 
        }else{

        }       
    }else{ 
      $results = $service->createSolution($title, $subserviceid, $problemDesc,$solution,$ref);
      if ($results) {
        $statusMsg = "Operation Success";
        $url = "Location: ../../index.php?successmsg=$statusMsg";
        redirectWithMsag($url);
      }else{
        $statusMsg = "Operation Failed ";
        $url = "Location: ../../index.php?errmsg=$statusMsg";
        redirectWithMsag($url);
      }
    }
      
      
  }

  /////////////// //////////////////////////////////////////////
  /// //////  NEW SERVICE FORM (service.php)////////////////////////////
  /// ////////////////////////////////////////////////
  /// 
  if (isset($_POST['new_service'])) {
    $name = mysqli_escape_string($conn, $_POST['service_name']);
    $description = mysqli_escape_string($conn, $_POST['service_description']);
    
    $results = $service->createService($name, $description);
    if ($results) {
      $statusMsg = "Operation Success";      
      $url = "Location: ../../pages/services.php?successmsg=$statusMsg";
      redirectWithMsag($url);

    }else{
      $statusMsg = "Operation Failed ";
      $url = "Location: ../../pages/services.php?errmsg=$statusMsg";
      redirectWithMsag($url);
    }    
  }

  /////////////// //////////////////////////////////////////////
  /// //////  NEW SOLUTIONS FORM (service.php)////////////////////////////
  /// ////////////////////////////////////////////////
  /// 
  if (isset($_POST['sub_service'])) {
    $name = mysqli_escape_string($conn, $_POST['subservice_name']);
    $parentservice = mysqli_escape_string($conn, $_POST['parent_service']);
    $description = mysqli_escape_string($conn, $_POST['service_description']);

    //var_dump([$name, $parentservice ,$description ]);   
    $results = $service->createSubService($name, $parentservice, $description);
    if ($results) {
      $statusMsg = "Operation Successful ";
      $url = "Location: ../../pages/services.php?successmsg=$statusMsg";
      redirectWithMsag($url);
    }else{
      $statusMsg = "Operation Failed ";
      $url = "Location: ../../pages/services.php?errmsg=$statusMsg";
      redirectWithMsag($url);
    }     
  }

  /////////////// //////////////////////////////////////////////
  /// //////  SEARCH functions ////////////////////////////
  /// ////////////////////////////////////////////////
  ///

  // if (isset($_POST['seach_btn'])) {
  //   $searchWord = mysqli_escape_string($conn, $_POST['solution_search']);

  //   //var_dump([$name, $parentservice ,$description ]);   
  //   $results = $service->search($searchWord);
  //   if ($results) {
  //     $statusMsg = "Operation Successful ";
  //     $url = "Location: ../../pages/services.php?successmsg=$statusMsg";
  //     redirectWithMsag($url);
  //   }else{
  //     $statusMsg = "Operation Failed ";
  //     $url = "Location: ../../pages/services.php?errmsg=$statusMsg";
  //     redirectWithMsag($url);
  //   } 
  // }
  /////////////// //////////////////////////////////////////////
  /// //////  UTIL functions ////////////////////////////
  /// ////////////////////////////////////////////////
  ///
  function redirectWithMsag($url){
    header($url);
    mysqli_close($conn);
    exit();
  }

  