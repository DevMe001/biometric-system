<?php

function baseUrl($url)
{
  $protocol = isset($_SERVER["HTTPS"]) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

  $domain = $_SERVER['HTTP_HOST'];
  $sub = explode('/', $_SERVER['REQUEST_URI']);



  $path = $protocol . $domain . '/' . $sub[1] . '/' . $sub[2] . '/' . $url;


  return $path;

}


function baseUrlImageSrc($url)
{
  $protocol = isset($_SERVER["HTTPS"]) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

  $domain = $_SERVER['HTTP_HOST'];
  $sub = explode('/', $_SERVER['REQUEST_URI']);



  $path = $protocol . $domain . '/' . $sub[1] .'/src'. '/images/' . $url;


  return $path;


}

function baseUrlScriptSrc($url)
{
  $protocol = isset($_SERVER["HTTPS"]) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

  $domain = $_SERVER['HTTP_HOST'];
  $sub = explode('/', $_SERVER['REQUEST_URI']);



  $path = $protocol . $domain . '/' . $sub[1] . '/src'  . $url;


  return $path;


}


function responseSend($status,$msg){
   echo json_encode(array('status'=>$status,'message'=>$msg));
}


function handleFileUpload($file, $target_dir)
{
  if ($file['error'] === UPLOAD_ERR_OK) {
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];

    if (move_uploaded_file($file_tmp_name, $target_dir . $file_name)) {
      // echo "File $file_name uploaded successfully.";

      return true;



    } else {
      echo "Error moving file $file_name to the target directory.";
    }
  } else {
    // Handle upload error
    echo "Upload error: {$file['error']}";
  }
}


// with rename
function handleFileUploadwithRename($file, $target_dir,$renameFile)
{
  if ($file['error'] === UPLOAD_ERR_OK) {
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION); // Get the file extension
    $newFileName = $renameFile . '.' . $extension; // Create the new file name
  
    if (move_uploaded_file($file['tmp_name'], $target_dir . $newFileName)) {
      // File was successfully renamed and moved to the target directory
      echo 'File renamed and uploaded successfully.';
    } else {
      // Error occurred while renaming and moving the file
      echo 'File upload failed.';
    }




  } else {
    // Handle upload error
    echo "Upload error: {$file['error']}";
  }
}


function isChosen($post){
  $value=0;
  if (!isset($post)){
     $value =0;
  }
  else{
    if ($post == 'on' || $post == 'true') {
      $value = 1;
    } else {
      $value = 0;
    }
  }

 return $value;

}

?>