<?php
session_start();
include('connection.php');

if (isset($_POST['load'])) {
    $user_id = $_SESSION['auth_user_id'];
    $content_query = "SELECT *FROM content_tb WHERE user_id = '$user_id'";
    $sql_connetion = mysqli_query($conn, $content_query);

    $array_result = [];

    if (mysqli_num_rows($sql_connetion) > 0) {
        foreach ($sql_connetion as $row) {
            $user_id = $row['user_id'];
            $user = "SELECT *FROM users_db WHERE user_id = '$user_id'";
            $user_connection = mysqli_query($conn, $user);
            $user_result = mysqli_fetch_array($user_connection);
            array_push($array_result, ['content' => $row, 'user' => $user_result]);
        }
        header('Content-Type: application/json');
        echo json_encode($array_result);
    }
}

if (isset($_POST["submit"])) {
    $name = mysqli_real_escape_string($conn, $_POST['content']);
    $user_id = $_SESSION['auth_user_id'];

    $filesArray = [];

    foreach ($_FILES['fileImg']['tmp_name'] as $key => $tmpName) {
        $imageName = $_FILES["fileImg"]["name"][$key];
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $imageExtension;

        move_uploaded_file($tmpName, 'uploads/' . $newImageName);
        $filesArray[] = $newImageName;
    }

    $filesJson = json_encode($filesArray);

    $query = "INSERT INTO content_tb (user_id,content, image) VALUES ('$user_id','$name', '$filesJson')";

    if (mysqli_query($conn, $query)) {
        header('location:../index.php');
    } else {
        echo "<script>alert('Error inserting data');</script>";
    }
}

if (isset($_POST['submit_delete'])) {

    $delete_content = mysqli_real_escape_string($conn, $_POST['content']);

    $delete_sql = "DELETE FROM content_tb WHERE content_id = '$delete_content' ";

    $delete_connection = mysqli_query($conn, $delete_sql);

    if ($delete_connection) {
    }
}

?>
