<!DOCTYPE HTML>
<html>

<head>
  <title>IPL-Matches</title>
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
      <div id = "menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="home.php">Home</a></li>
          <li><a href="teams.php">Teams</a></li>
          <li><a href="players.php">Players</a></li>
          <li class = "selected"><a href="matches.php">Matches</a></li>
          <li><a href="stats.php">Interesting Stuff</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="matches.php?year=2008">2008</a></li>
          <li><a href="matches.php?year=2009">2009</a></li>
          <li><a href="matches.php?year=2010">2010</a></li>
          <li><a href="matches.php?year=2011">2011</a></li>
          <li><a href="matches.php?year=2012">2012</a></li>
          <li><a href="matches.php?year=2013">2013</a></li>
          <li><a href="matches.php?year=2014">2014</a></li>
          <li><a href="matches.php?year=2015">2015</a></li>
          <li><a href="matches.php?year=2016">2016</a></li>
          <li><a href="matches.php?year=2017">2017</a></li>
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
        $query = 'SELECT match_id,team1,team2,match_date,season_year,venue_name,city_name,country_name,toss_winner,match_winner,toss_name,win_type,outcome_type,manofmatch,win_margin FROM match';
        if(isset($_GET["year"])){
          $year = $_GET["year"];
          $query = "SELECT match_id,team1,team2,match_date,season_year,venue_name,city_name,country_name,toss_winner,match_winner,toss_name,win_type,outcome_type,manofmatch,win_margin FROM match WHERE match_date LIKE '%".$year."%'";
        }

        $result = pg_query($query) or die('Query failed: ' . pg_last_error());

        // Printing results in HTML

        echo "<ul>\n";
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
          echo "<li><a href = './match_card.php?match_id={$line['match_id']}' ><h4>{$line['team1']} vs {$line['team2']}</h4></a><br>";
          echo "Played on {$line['match_date']} at {$line['venue_name']}, {$line['city_name']}, {$line['country_name']}<br>";
          if($line['outcome_type'] == 'Abandoned'){
            echo "The match was Abandoned<br>";
          }
          elseif($line['outcome_type'] == 'Rain'){
            echo "{$line['toss_winner']} won the toss and chose to {$line['toss_name']}<br>";  
            echo "The match was washed out from rain<br>";
          }
          elseif($line['outcome_type'] == 'Superover'){
            echo "{$line['toss_winner']} won the toss and chose to {$line['toss_name']}<br>";  
            echo "{$line['match_winner']} won the match in the superover<br>";
          }
          else{
            echo "{$line['toss_winner']} won the toss and chose to {$line['toss_name']}<br>";
            echo "{$line['match_winner']} won the match by {$line['win_margin']} {$line['win_type']}<br>";
            echo "{$line['manofmatch']} was declared Man of the Match<br>";
          }
          echo "</li>\n";
        }
        echo "</ul>\n";
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
