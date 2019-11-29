<?php
$db = mysqli_connect("127.0.0.1", "alejandro", "root", "game");
mysqli_select_db($db, 'game') or die(mysqli_error($db));


if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            student_id, student_fullname, student_isactor, student_isdirector
        FROM
            student
        WHERE
            student_id = ' . $_GET['id'];

    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    //set values to blank
    $student_id = '';
    $student_fullname = '';
    $student_isactor = '';
    $student_isdirector = '';
}
if (isset($_GET['error']) && $_GET['error'] != '') {
    echo '<div id="error">' . $_GET['error'] . '</div>';
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> student</title>
  <style type="text/css">
    #error { background-color: #600; border: 1px solid #FF0; color: #FFF;
    text-align: center; margin: 10px; padding: 10px; }

</style>

 </head>
 <body>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=student"
   method="post">
   <table>
    <tr>
     <td>Full Name: </td>
     <td><input type="text" name="student_fullname"
      value="<?php echo $student_fullname; ?>"/></td>
    </tr><tr>
    <tr>
     <td>Actor: </td>
      <td><select name="student_isactor">
          <option value="1" <?php if ($student_isactor=='1') echo "selected"?>>Si</option>
          <option value="0" <?php if ($student_isactor=='0') echo "selected"?>>No</option>
        <?php

        ?>

     </td>
    </tr><tr>
    <tr>
     <td>Director: </td>
     <td><select name="student_isdirector">
       <option value="1" <?php if ($student_isdirector=='1') echo "selected"?>>Si</option>
       <option value="0" <?php if ($student_isdirector=='0') echo "selected"?>>No</option>
          
     </td>
    </tr>
    <tr>
     <td>Email: </td>
     <td><input type="text" name="email" id="email"
      value=""/></td>
    </tr><tr>
    <tr>
    

<?php
// select actor records
$query = 'SELECT
        student_id, student_fullname
    FROM
        student
    WHERE
        student_isactor = 1
    ORDER BY
        student_fullname';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
?>

<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="student_id" />';
}
?>
      <input type="submit" name="submit"
       value="<?php echo ucfirst($_GET['action']); ?>" />
       
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>
