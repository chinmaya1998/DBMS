<!DOCTYPE HTML>
<html>

<head>
  <title>Login</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="home.php">IPL</a></h1>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="home.php">Home</a></li>
          <li><a href="teams.php">Teams</a></li>
          <li><a href="players.php">Players</a></li>
          <li><a href="matches.php">Matches</a></li>
          <li><a href="stats.php">Interesting Stuff</a></li>
          <li class = "selected"><a href="login.php">Login</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
        <h1>Login Page</h1>
        <p>Enter your username and password to login: </p>
        <form action="login.php" method="post">
          <div class="form_settings">
            <p><span>UserName</span><input class="contact" type="text" name="usname" value="" /></p>
            <p><span>Password</span><input class="contact" type="password" name="pwd" value="" /></p>
            <p style="padding-top: 15px"><input class="submit" type="submit" name="login_submitted" value="SUBMIT" /></p>
          </div>
        </form>

        <?php
        // Connecting, selecting database
        $dbconn = pg_connect("host=localhost dbname=ipl user=postgres password=col362")
        or die('Could not connect: ' . pg_last_error());

        if(isset($_POST["usname"])){
          $usname = $_POST["usname"]; 
          $pwd = $_POST["pwd"];
          $query = "SELECT password FROM login WHERE uname = '".$usname."'";
          $result = pg_query($query) or die('Query failed: ' . pg_last_error());
          $row = pg_fetch_all($result);
          if($row == FALSE){
            echo "<p>Username does not exist!! <br/> Try Again";
            }
          else{
            if($row[0]['password']==$pwd){
              echo "<script> window.location.assign('login_home.php?usname=$usname'); </script>";
            }
            else{
              echo "<p>Your password is wrong! <br/> Try Again";
            }
          }
          pg_free_result($result);
          }
        else{
          $usname = "default";
        }
        // Performing SQL query

        // Printing results in HTML
        

        // Free resultset
        
        // Closing connection
        pg_close($dbconn);
        ?>
      </div>
    </div>
    <div id="footer">
      Made by Chinmaya Singh, Vivek Singal and Adarsh Agarwal
    </div>
  </div>
</body>
</html>
