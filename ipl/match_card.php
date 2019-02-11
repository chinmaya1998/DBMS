<!DOCTYPE HTML>
<html>

<head>
  <title>IPL-Scorecard</title>
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
          <li class = "selected"><a href="matches.php">Matches</a></li>
          <li><a href="stats.php">Interesting Stuff</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
        <h1>Score Card</h1>
        <?php
        // Connecting, selecting database
        $dbconn = pg_connect("host=localhost dbname=ipl user=postgres password=col362")
        or die('Could not connect: ' . pg_last_error());

        if(isset($_GET["match_id"]))
        {
          $match_id = $_GET["match_id"];
          echo "Match ID is ".$match_id;
        }

        // Performing SQL query
        $query = 'SELECT match_id,team1,team2,match_date,season_year,venue_name,city_name,country_name,toss_winner,match_winner,toss_name,win_type,outcome_type,manofmatch,win_margin FROM match';
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());

        // Printing results in HTML

        

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
