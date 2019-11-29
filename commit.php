<?php
$db = mysqli_connect("127.0.0.1", "alejandro", "root", "game");
mysqli_select_db($db, 'game') or die(mysqli_error($db));
?>
<html>
 <head>
  <title>Commit</title>
 </head>
 <body>

<?php
$email=$_POST['email'];
echo "asdsadsadas" . $email;
switch ($_GET['action']) {
case 'add':
    switch ($_GET['type']) {
    case 'game':
        $error = array();
        $game_name = isset($_POST['game_name']) ?
            trim($_POST['game_name']) : '';
        if (empty($game_name)) {
            $error[] = urlencode('Please enter a game name.');
        }
        $game_type = isset($_POST['game_type']) ?
            trim($_POST['game_type']) : '';
        if (empty($game_type)) {
            $error[] = urlencode('Please select a game type.');
        }
        $game_year = isset($_POST['game_year']) ?
            trim($_POST['game_year']) : '';
        if (empty($game_year)) {
            $error[] = urlencode('Please select a game year.');
        }
        $game_leadactor = isset($_POST['game_leadactor']) ?
            trim($_POST['game_leadactor']) : '';
        if (empty($game_leadactor)) {
            $error[] = urlencode('Please select a lead actor.');
        }
        $game_director = isset($_POST['game_director']) ?
            trim($_POST['game_director']) : '';
        if (empty($game_director)) {
            $error[] = urlencode('Please select a director.');
        }
        if (empty($error)) {
        $query = 'INSERT INTO
            game
                (game_name, game_year, game_type, game_leadactor,
                game_director)
            VALUES
                ("' . $_POST['game_name'] . '",
                 ' . $_POST['game_year'] . ',
                 ' . $_POST['game_type'] . ',
                 ' . $_POST['game_leadactor'] . ',
                 ' . $_POST['game_director'] . ')';
        break;
    }else {
        header('Location:game.php?action=add' .
            '&error=' . join($error, urlencode('<br/>')));
      }


    case 'student':
        $error = array();
        $student_fullname = isset($_POST['student_fullname']) ?
            trim($_POST['student_fullname']) : '';
        if (empty($student_fullname)) {
            $error[] = urlencode('Please enter a students name.');
        }
        $student_isactor = isset($_POST['student_isactor']) ?
            trim($_POST['student_isactor']) : '';
        if (empty($student_isactor)) {
            $error[] = urlencode('Please select  a correct type.');
        }
        $student_isdirector = isset($_POST['student_isdirector']) ?
            trim($_POST['student_isdirector']) : '';
        if (empty($student_isdirector)) {
            $error[] = urlencode('Please select  a correct type.');
        }
        $email = isset($_POST['email']) ?
            trim($_POST['email']) : '';
        if (empty($email)) {
            $error[] = urlencode('Please enter a email.');
        }
        function email_validation($email) { 
            return (!preg_match( 
        "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) 
                ? FALSE : TRUE; 
        } 
        if(!email_validation($email)) { 
            echo "Invalid email address."; 
            $error[] = urlencode('Please enter a email.');
        } 
        else { 
            echo "Valid email address."; 
        }


        if (empty($error)) {
        $query = 'INSERT INTO student
            (student_fullname, student_isactor, student_isdirector)
        VALUES
            ("' . $_POST['student_fullname'] . '",
            ' . $_POST['student_isactor'] . ',
            ' . $_POST['student_isdirector'] . ')';
        break;
    }
    else {
        header('Location:student.php?action=add' .
            '&error=' . join($error, urlencode('<br/>')));
      }
    }
    break;
case 'edit':
    switch ($_GET['type']) {
    case 'game':
        $error = array();
        $game_name = isset($_POST['game_name']) ?
            trim($_POST['game_name']) : '';
        if (empty($game_name)) {
            $error[] = urlencode('Please enter a game name.');
        }
        $game_type = isset($_POST['game_type']) ?
            trim($_POST['game_type']) : '';
        if (empty($game_type)) {
            $error[] = urlencode('Please select a game type.');
        }
        $game_year = isset($_POST['game_year']) ?
            trim($_POST['game_year']) : '';
        if (empty($game_year)) {
            $error[] = urlencode('Please select a game year.');
        }
        $game_leadactor = isset($_POST['game_leadactor']) ?
            trim($_POST['game_leadactor']) : '';
        if (empty($game_leadactor)) {
            $error[] = urlencode('Please select a lead actor.');
        }
        $game_director = isset($_POST['game_director']) ?
            trim($_POST['game_director']) : '';
        if (empty($game_director)) {
            $error[] = urlencode('Please select a director.');
        }
        if (empty($error)) {
        $query = 'UPDATE game SET
                game_name = "' . $_POST['game_name'] . '",
                game_year = ' . $_POST['game_year'] . ',
                game_type = ' . $_POST['game_type'] . ',
                game_leadactor = ' . $_POST['game_leadactor'] . ',
                game_director = ' . $_POST['game_director'] . '
            WHERE
                game_id = ' . $_POST['game_id'];
        }
        else {
            header('Location:game.php?action=edit&id=' . $_POST['game_id'] .
                '&error=' . join($error, urlencode('<br/>')));
          }
        break;
    case 'student':
        $error = array();
        $student_fullname = isset($_POST['student_fullname']) ?
            trim($_POST['student_fullname']) : '';
        if (empty($student_fullname)) {
            $error[] = urlencode('Please enter a students name.');
        }
        $student_isactor = isset($_POST['student_isactor']) ?
            trim($_POST['student_isactor']) : '';
        if (empty($student_isactor)) {
            $error[] = urlencode('Please select  a correct type.');
        }
        $student_isdirector = isset($_POST['student_isdirector']) ?
            trim($_POST['student_isdirector']) : '';
        if (empty($student_isdirector)) {
            $error[] = urlencode('Please select a correct type.');
        }
        if (empty($error)) {
        $query = 'UPDATE student SET
                student_fullname = "' . $_POST['student_fullname'] . '",
                student_isactor = "' . $_POST['student_isactor'] . '",
                student_isdirector = "' . $_POST['student_isdirector'] . '"
            WHERE
                student_id = ' . $_POST['student_id'];
        break;
    }
    else {
        header('Location:student.php?action=edit&id=' . $_POST['student_id'] .
            '&error=' . join($error, urlencode('<br/>')));
      }
    }
    break;
}

if (isset($query)) {
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
}
?>
  <p>Done!</p>
  <a href="tabla.php">Volver al Index</a></p>
 </body>
</html>
