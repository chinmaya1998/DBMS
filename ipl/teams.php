<!DOCTYPE HTML>
<html>

<head>
  <title>IPL-Teams</title>
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
          <li class = "selected"><a href="teams.php">Teams</a></li>
          <li><a href="players.php">Players</a></li>
          <li><a href="matches.php">Matches</a></li>
          <li><a href="stats.php">Interesting Stuff</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
        <?php
        // Connecting, selecting database
        $dbconn = pg_connect("host=localhost dbname=ipl user=postgres password=col362")
        or die('Could not connect: ' . pg_last_error());

        // Performing SQL query
        $query = 'SELECT * FROM team';
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());

        // Printing results in HTML
        echo "<table>\n";
        echo "<tr><th>Team_SK</th><th>Team_ID</th><th>Team Name</th></tr>";
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
          echo "\t<tr>\n";
          foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
            }
          echo "\t</tr>\n";
        }
        echo "</table>\n";

        // Free resultset
        pg_free_result($result);

        // Closing connection
        pg_close($dbconn);
        ?>

        
        <h2>Form Elements</h2>
        <form action="#" method="post">
          <div class="form_settings">
            <p><span>Form field example</span><input type="text" name="name" value="" /></p>
            <p><span>Textarea example</span><textarea rows="8" cols="50" name="name"></textarea></p>
            <p><span>Checkbox example</span><input class="checkbox" type="checkbox" name="name" value="" /></p>
            <p><span>Dropdown list example</span><select id="id" name="name"><option value="1">Example 1</option><option value="2">Example 2</option></select></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="name" value="button" /></p>
          </div>
        </form>
      </div>
    </div>
    <div id="footer">
      Made by Chinmaya Singh, Vivek Singal and Adarsh Agarwal 
    </div>
  </div>
</body>
</html>
