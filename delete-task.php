<?php 

    include('config/constants.php');
    session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';

};
    //Check task_id in URL
    if(isset($_GET['task_id']))
    {
        //Delete the Task from Database
        //Get the Task ID
        $task_id = $_GET['task_id'];
        
        //Connect Databaes
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        //SElect Database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        
        //SQL Query to DELETE TASK
        $sql = "DELETE FROM tbl_tasks WHERE task_id=$task_id";
        
        //Execute Query
        $res = mysqli_query($conn, $sql);
        
        //CHeck if the Query Executed Successfully or Not
        if($res==true)
        {
            //Query Executed Successfully and TAsk Deleted
            $_SESSION['delete'] = "Task Deleted Successfully.";
            
            //redirect to Homepage
            header('location:'.task);
        }
        else
        {
            //FAiled to Delete Task
            $_SESSION['delete_fail'] = "Failed to Delete Task";
            
            //Redirect to Home PAge
            header('location:'.task);
        }
        
    }
    else
    {
        //Redirect to Home
        header('location:'.task);
    }

?>