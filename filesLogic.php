<?php

$conn = mysqli_connect("localhost", "root", "", "file_upload");
$sql = "SELECT*FROM files";
$result = mysqli_query($conn, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['save'])) {
    $filename = $_FILES['myfile']['name'];
    $destinstion = 'uploads/' . $filename;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
    if (!in_array($extension, ['zip', 'pdf', 'png'])) {
        echo "your fiile extension must be .zip, .pdf or .png ";
    } elseif ($_FILES['myfile']['size'] > 1000000) {
        echo "file is too large";
    } else {
        if (move_uploaded_file($file, $destinstion)) {
            $sql = "INSERT INTO files(name,size,downloads)" . "VALUES('$filename','$size',0)";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";
                header("Location: user_Reportdownload.php");
            } else {
                echo "failed to the upload file";
                
            }
        }
    }
}


if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];
    $sql = "SELECT *FROM files WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $flie = mysqli_fetch_assoc($result);
    $filepath = 'storage/ReportStorage/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Type: application/octet-stream');
        header('Content-Description: File Transfer');
        header('Content-Description: attachment; filename =' . basename($filepath));
        header('expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize('storage/ReportStorage/' . $file['name']));
        readfile('storage/ReportStorage/' . $flie['name']);
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads = $newCount WHERE id = $id";

        mysqli_query($conn, $updateQuery);

        exit;
    }
}
?>