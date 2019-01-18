<?php
		
if(session_id() != $_COOKIE['PHPSESSID'] || !$_COOKIE['PHPSESSID']) {

    session_start();

}

        require 'mysql.php';

		require 'lightopenid/openid.php';

		$_STEAMAPI = "DD707C33CB960F4B4C02019A2A35D91B";
		try {
            
		    $openid = new LightOpenID('127.0.0.1');
		    if(!$openid->mode) {
                
		        if(isset($_GET['login'])) {
                    
		            $openid->identity = 'http://steamcommunity.com/openid/?l=english';    
		            // This is forcing english because it has a weird habit of selecting a random language otherwise
		            header('Location: ' . $openid->authUrl());
                    
		        }
                
            } elseif($openid->mode == 'cancel') {
                    
			        echo 'User has canceled authentication!';	
                
                } else {
                    
			        if($openid->validate()) {
                        
			                $id = $openid->identity;
			                // identity is something like: http://steamcommunity.com/openid/id/76561197960435530
			                // we only care about the unique account ID at the end of the URL.
			                $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
			                preg_match($ptn, $id, $matches);
			
			                $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$_STEAMAPI&steamids=$matches[1]";
			                $json_object= file_get_contents($url);
			                $json_decoded = json_decode($json_object);
                        
                            foreach ($json_decoded->response->players as $player) {
                                
                                // Check player id.
                                
                                // We will also update their player id in vx.accounts
                                $QUERY_LINK_PLAYERID = mysqli_query($conn, "
                                
                                UPDATE vx.accounts
                                SET vx.accounts.playerID = (

                                SELECT 
                                vx.players.id
                                FROM vx.players
                                WHERE vx.players.pid = '" . $player->steamid . "'
                                
                                )
                                WHERE vx.accounts.username = '" . $_COOKIE['USERNAME'] . "' AND '" . $_SESSION['USERID'] . "';

                                
                                ");
                                
                                $QUERY_UPDATE_MEMBERSHIP_LEVEL = mysqli_query($conn, "
                                
                                UPDATE vx.accounts
                                SET vx.accounts.membershipLevelID = 2 
                                WHERE vx.accounts.playerID = (

                                SELECT 
                                vx.players.id
                                FROM vx.players
                                WHERE vx.players.pid = '" . $player->steamid . "'

                                ) AND vx.accounts.membershipLevelID IS NULL OR vx.accounts.membershipLevelID = 1;
                                
                                ");
                                
                                header('Location: index.php');
                                
                            } 
                        
                        } 
                    
                    }
			
                } catch(ErrorException $e) {
			
			    echo $e->getMessage();
			
                }

			?>