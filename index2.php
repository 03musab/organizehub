<?php 
// Include configuration file 
include_once 'config.php'; 
 
$postData = ''; 
if(!empty($_SESSION['postData'])){ 
    $postData = $_SESSION['postData']; 
    unset($_SESSION['postData']); 
} 
 
$status = $statusMsg = ''; 
if(!empty($_SESSION['status_response'])){ 
    $status_response = $_SESSION['status_response']; 
    $status = $status_response['status']; 
    $statusMsg = $status_response['status_msg']; 
} 
?>

<!-- Status message -->
<?php if(!empty($statusMsg)){ ?>
    <div class="alert alert-<?php echo $status; ?>"><?php echo $statusMsg; ?></div>
<?php } ?>
<style>
    /* Form container */
.col-md-12 {
  width: 100%;
}

/* Form styling */
.form {
  margin-top: 20px;
}

/* Form group styling */
.form-group {
  margin-bottom: 15px;
}

/* Label styling */
label {
  display: block;
  font-weight: bold;
}

/* Input and textarea styling */
.form-control {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Time input fields styling */
.time {
  display: flex;
  align-items: center;
}

/* Span between time inputs */
.time span {
  margin: 0 10px;
}

/* Submit button styling */
input[type="submit"] {
  width: auto;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* Submit button hover effect */
input[type="submit"]:hover {
  background-color: #0056b3;
}

</style>

<div class="col-md-12">
    <form method="post" action="addEvent.php" class="form">
        <div class="form-group">
            <label>Event Title</label>
            <input type="text" class="form-control" name="title" value="<?php echo !empty($postData['title'])?$postData['title']:''; ?>" required="">
        </div>
        <div class="form-group">
            <label>Event Description</label>
            <textarea name="description" class="form-control"><?php echo !empty($postData['description'])?$postData['description']:''; ?></textarea>
        </div>
        <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="<?php echo !empty($postData['location'])?$postData['location']:''; ?>">
        </div>
        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" class="form-control" value="<?php echo !empty($postData['date'])?$postData['date']:''; ?>" required="">
        </div>
        <div class="form-group time">
            <label>Time</label>
            <input type="time" name="time_from" class="form-control" value="<?php echo !empty($postData['time_from'])?$postData['time_from']:''; ?>">
            <span>TO</span>
            <input type="time" name="time_to" class="form-control" value="<?php echo !empty($postData['time_to'])?$postData['time_to']:''; ?>">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn-primary" name="submit" value="Add Event"/>
        </div>
    </form>
</div>