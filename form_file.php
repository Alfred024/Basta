
<?php 
    $path="./files/";
    //var_dump($_FILES['file_upload']);
    // $_FILES['file_upload']; = $_FILES['file_upload'];
    // move_uploaded_file($_FILES['file_upload']['name'], "./files/".$_FILES['file_upload']['name']);
    if(!is_dir('files')){
        mkdir('files');
    }

    $files_dir = opendir($path);
    while ($file = readdir($files_dir)) {
        $file_type = pathinfo($file, PATHINFO_EXTENSION);

        $file_icon = ""; 
        switch ($file_type) {
            case 'png':
                $file_icon .= '<img src="https://cdn-icons-png.flaticon.com/512/136/136441.png" alt="" style="width: 16px">';
            break;
            case 'pdf':
                $file_icon .= '<i class="fa-solid fa-file-pdf"></i>';
            break;
            case 'jpg':
                $file_icon .= '<img src="https://www.svgrepo.com/show/138840/jpg-file.svg" alt="" style="width: 16px">';
            break;
            default:
                $file_icon .= '<i class="fa-regular fa-file-image"></i>';
                break;
        }
        echo $file_icon.$file."<br>";
    }
    
    if(
        isset($_FILES['file_upload']) 
        && $_FILES['file_upload']['name'] > "" 
        //&& $_FILES['file_upload']['size'] <= 1000 * 1024 
    ){
        move_uploaded_file($_FILES['file_upload']['tmp_name'], $path.$_FILES['file_upload']['name']);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Font Awesome -->
    <script
      src="https://kit.fontawesome.com/cdb751df44.js"
      crossorigin="anonymous"
    ></script>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <label for="">Suba un archivo</label>
        <input type="file" name="file_upload">
        <input type="submit">
    </form>
</body>
</html>

<?php 

?>