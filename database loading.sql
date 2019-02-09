CREATE TABLE ball(match_id int,over_id int,ball_id int,innings_no int,team_batting int,team_bowling int,striker_batting_position int,extra_type text,runs_scored int,extra_runs int,wides int,legbyes int,byes int,noballs int,penalty int,bowler_extras int,out_type text,caught int,bowled int,run_out int,lbw int,retired_hurt int,stumped int,caught_bowled int,hit_wicket int,obstructingfield int,bowler_wicket int,match_date text,season int,striker int,non_striker int,bowler int,player_out int,fielders int,striker_match_sk int,strikersk int,nonstriker_match_sk int,nonstriker_sk int,fielder_match_sk int,fielder_sk int,bowler_match_sk int,bowler_sk int,playerout_match_sk int,battingteam_sk int,bowlingteam_sk int,keeper_catch int,player_out_sk int,matchdatesk text);
CREATE TABLE team(team_sk int,team_id int,team_name text);
CREATE TABLE player(player_sk int,player_id int,player_name text,dob text,batting_hand text,bowling_skill text,country_name text);
CREATE TABLE match(match_sk int,match_id int,team1 text,team2 text,match_date text,season_year int,venue_name text,city_name text,country_name text,toss_winner text,match_winner text,toss_name text,win_type text,outcome_type text,manofmatch text,win_margin int,country_id int);
UPDATE player SET bowling_skill = null WHERE bowling_skill = 'NULL';
UPDATE player SET bowling_skill = null WHERE bowling_skill = 'N/A';



