<!DOCTYPE HTML>
<html>

<head>
  <title>IPL-Players</title>
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
          <li class = "selected"><a href="players.php">Players</a></li>
          <li><a href="matches.php">Matches</a></li>
          <li><a href="stats.php">Interesting Stuff</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
        <h2>Filters</h2>
        <form action="players.php" method="get">
          <h4>By Country</h4>
          <select name="country[]" size="12" multiple>
            <option value="India">India</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Australia">Australia</option>
            <option value="West Indies">West Indies</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="England">England</option>
            <option value="Sri Lanka">Sri Lanka</option>
            <option value="Afghanistan">Afghanistan</option>
            <option value="New Zealand">New Zealand</option>
            <option value="South Africa">South Africa</option>
            <option value="Netherlands">Netherlands</option>
            <option value="Zimbabwea">Zimbabwea</option>
          </select><br>
          <h4>By Batting Hand</h4>
          <select name="bat" size="2">
            <option value="Right">Right</option>
            <option value="Left">Left</option>
          </select><br>
          <h4>By Bowling Hand</h4>
          <select name="bowl" size="2">
            <option value="Right">Right</option>
            <option value="Left">Left</option>
          </select><br>
          <input type="submit">
        </form>

        <?php
        // Connecting, selecting database
        $dbconn = pg_connect("host=localhost dbname=ipl user=postgres password=col362")
        or die('Could not connect: ' . pg_last_error());

        // Performing SQL query
        
        $check=0;
        $query1='';
        $query2='';
        $query3='';
        if(isset($_GET["country"])){
          $check=1;
          $country = $_GET["country"];
          $country_list = "(";
          foreach($country as $c){
            $country_list = $country_list."'".$c."'".',';
          }
          $country_list = $country_list."'".$c."'".')';
          $query1 = 'SELECT player_id,player_name,dob,batting_hand,bowling_skill,country_name FROM player WHERE country_name IN '.$country_list;
        }

        if(isset($_GET["bowl"])){
          $check=1;
          $bowl = $_GET["bowl"];
          if($bowl=='Right'){
            $query2 = "SELECT player_id,player_name,dob,batting_hand,bowling_skill,country_name FROM player WHERE lower(bowling_skill) LIKE '%right%' OR lower(bowling_skill) LIKE '%leg%'";
          }
          elseif($bowl=='Left'){
            $query2 = "SELECT player_id,player_name,dob,batting_hand,bowling_skill,country_name FROM player WHERE lower(bowling_skill) LIKE '%left%'";
          }
          
        }
        if(isset($_GET["bat"])){
          $check=1;
          $bat = $_GET["bat"];
          if($bat=='Right'){
            $query3 = "SELECT player_id,player_name,dob,batting_hand,bowling_skill,country_name FROM player WHERE lower(batting_hand) LIKE '%right%'";
          }
          elseif($bat=='Left'){
            $query3 = "SELECT player_id,player_name,dob,batting_hand,bowling_skill,country_name FROM player WHERE lower(batting_hand) LIKE '%left%'";
          }
        }
        $query='';
        if($query1 != '')
        {
          $query = $query1;
        }
        if($query2 != '')
        {
          if($query==''){
            $query=$query2;
          }
          else{
            $query = $query.' INTERSECT '.$query2;
          }
        }
        if($query3 != '')
        {
          if($query==''){
            $query=$query3;
          }
          else{
            $query = $query.' INTERSECT '.$query3;
          }
        }
        if($query==''){
          $query = 'SELECT player_id,player_name,dob,batting_hand,bowling_skill,country_name FROM player ORDER BY player_id';  
        }
        
        echo '<br>';
        echo $query;
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
        // Printing results in HTML
        echo "<table>\n";
        echo "<tr><th>Player_ID</th><th>Player Name</th><th>Date of Birth</th><th>Batting Style</th><th>Bowling Style</th><th>Country Name</th></tr>";
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

      </div>
    </div>
    <div id="footer">
      Made by Chinmaya Singh, Vivek Singal and Adarsh Agarwal 
    </div>
  </div>
</body>
</html>
