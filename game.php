<?php
$db = mysqli_connect("127.0.0.1", "alejandro", "root", "game");
mysqli_select_db($db, 'game') or die(mysqli_error($db));
if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
           game_name,game_type,game_year,game_leadactor,game_director
        FROM
           game
        WHERE
           game_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    //set values to blank
    $game_name = '';
    $game_type = 0;
    $game_year = date('Y');
    $game_leadactor = 0;
    $game_director = 0;
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?>game</title>
 </head>
 <body>
 <?php
if (isset($_GET['error']) && $_GET['error'] != '') {
    echo '<div id="error">' . $_GET['error'] . '</div>';
}
?>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=game"
   method="post">
   <table>
    <tr>
     <td>game Name</td>
     <td><input type="text" name="game_name"
      value="<?php echo $game_name; ?>"/></td>
    </tr><tr>
     <td>game Type</td>
     <td><select name="game_type">
<?php
// select thegame type information
$query = 'SELECT
       gametype_id,gametype_label
    FROM
       gametype
    ORDER BY
       gametype_label';
$result = mysqli_query($db, $query) or die(mysqli_error($db));

// populate the select options with the results
while ($row = mysqli_fetch_assoc($result)) {
    
        if ($row['gametype_id'] == $game_type) {
            echo '<option value="' . $row['gametype_id'] .
                '" selected="selected">';
        } else {
            echo '<option value="' . $row['gametype_id'] . '">';
        }
        echo $row['gametype_label'] . '</option>';
    
}
?>
      </select></td>
    </tr><tr>
     <td>game Year</td>
     <td><select name="game_year">
<?php
// populate the select options with years
for ($yr = date("Y"); $yr >= 1970; $yr--) {
    if ($yr == $game_year) {
        echo '<option value="' . $yr . '" selected="selected">' . $yr .
            '</option>';
    } else {
        echo '<option value="' . $yr . '">' . $yr . '</option>';
    }
}
?>
      </select></td>
    </tr><tr>
     <td>Lead Actor</td>
     <td><select name="game_leadactor">
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

// populate the select options with the results
while ($row = mysqli_fetch_assoc($result)) {
   
        if ($row['student_id'] == $game_leadactor) {
            echo '<option value="' . $row['student_id'] .
                '" selected="selected">';
        } else {
            echo '<option value="' . $row['student_id'] . '">';
        }
        echo $row['student_fullname'] . '</option>';
    
}
?>
      </select></td>
    </tr><tr>
     <td>Director</td>
     <td><select name="game_director">
<?php
// select director records
$query = 'SELECT
        student_id, student_fullname
    FROM
        student
    WHERE
        student_isdirector = 1
    ORDER BY
        student_fullname';
$result = mysqli_query($db, $query) or die(mysqli_error($db));

// populate the select options with the results
while ($row = mysqli_fetch_assoc($result)) {
    
        if ($row['student_id'] == $game_director) {
            echo '<option value="' . $row['student_id'] .
                '" selected="selected">';
        } else {
            echo '<option value="' . $row['student_id'] . '">';
        }
        echo $row['student_fullname'] . '</option>';
    
}
?>
      </select></td>
    </tr><tr>
     <td colspan="2" style="text-align: center;">
<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="game_id" />';
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
