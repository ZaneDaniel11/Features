<?php

session_start();
include('connection.php');

if(isset($_POST['delete_comment_btn']))
{
    $delete_comment = mysqli_real_escape_string($conn,$_POST['delete_comment']);

    $delete_comment_sql = "DELETE FROM comment_tb WHERE id = '$delete_comment' ";

    $delete_c_connectiommenton = mysqli_query($conn,$delete_comment_sql);

}

if(isset($_POST['view_comment'])){

    $reply_id = mysqli_real_escape_string($conn,$_POST['reply_on_comment_id']);
    $view_reply_query = "SELECT *FROM comment_reply_tb WHERE comment_id = '$reply_id'";

    $view_reply_connection = mysqli_query($conn, $view_reply_query);

    $array_comment_result = [];

    if(mysqli_num_rows($view_reply_connection) > 0)
    {
        foreach($view_reply_connection as $row)
        {
            $user_id = $row['user_id'];
            $view_reply_user = "SELECT *FROM users_db WHERE user_id = '$user_id' LIMIT 1";

            $view_user_reply = mysqli_query($conn, $view_reply_user);

            $reply_result = mysqli_fetch_array($view_user_reply);

            array_push($array_comment_result, ['rcmt'=>$row, 'user'=>$reply_result]);
        }
        header('Content-Type: application/json');
        echo json_encode($array_comment_result);
      
    }
    else
    {
        echo 'Shesh';
    }
    
}




if (isset($_POST['reply_btn'])) {

    $reply_id = mysqli_real_escape_string($conn, $_POST[['reply_id']]);

    $view_reply_query = "SELECT *FROM comment_reply_tb WHERE comment_id = '$reply_id'";

    $view_reply_connection = mysqli_query($conn, $view_reply_query);

    $array_comment_result = [];

    if (mysqli_num_rows($view_reply_connection) > 0) {
        foreach ($view_reply_connection as $row) {
            $user_id = $row['user_id'];
            $view_reply_user = "SELECT *FROM users_db WHERE user_id = '$user_id'";

            $view_user_reply = mysqli_query($conn, $view_reply_user);

            $reply_result = mysqli_fetch_array($view_user_reply);

            array_push($array_comment_result, ['rcmt'=>$row, 'user'=> $reply_result]);
        }
        header('Content-type: application/json');
        echo json_encode($array_comment_result);
    }
}

if (isset($_POST['add_reply'])) {
    $comment_id = mysqli_real_escape_string($conn, $_POST['comment_id']);
    $reply = mysqli_real_escape_string($conn, $_POST['reply']);

    $user_id = $_SESSION['auth_user_id'];
    $query = "INSERT INTO comment_reply_tb (user_id,comment_id,reply_msg) VALUES ('$user_id','$comment_id','$reply')";

    $query_conn = mysqli_query($conn, $query);

    if ($query_conn) {
        echo 'Comment Added';
    } else {
        echo 'Comment not added';
    }
}


if (isset($_POST['comment_load_data'])) {
    $comments_query = "SELECT * FROM comment_tb";
    $comments_query_run = mysqli_query($conn, $comments_query);

    $array_result = [];

    if (mysqli_num_rows($comments_query_run) > 0) {
        foreach ($comments_query_run as $row) {
            $user = $row['user_id'];

            $user_query = "SELECT * FROM users_db WHERE user_id ='$user' LIMIT 1";
            $user_query_run = mysqli_query($conn, $user_query);

            $user_result = mysqli_fetch_array($user_query_run);

            array_push($array_result, ['cmt' => $row, 'user' => $user_result]);
        }
        header('Content-type: application/json');
        echo json_encode($array_result);
    } else {
        echo json_encode(['error' => 'No comments found']);
    }
} elseif (isset($_POST['add_comment'])) {
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);
    $user_id = $_SESSION['auth_user_id'];


    $query = "INSERT INTO comment_tb (user_id, msg) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'is', $user_id, $msg);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Comment Added Successfully";
        } else {
            echo "Comment not added. Something went wrong with the query execution: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing the statement: " . mysqli_error($conn);
    }
} 