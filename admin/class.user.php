<?php
class USER
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	function sec_session_start() {
		$session_name = 'sec_session_id';   // Set a custom session name 
		$secure = FALSE;
	
		// This stops JavaScript being able to access the session id.
		$httponly = true;
	
		// Forces sessions to only use cookies.
		if (ini_set('session.use_only_cookies', 1) === FALSE) {
			header("Location: error.php?err=Could not initiate a safe session (ini_set)");
			exit();
		}
	
		// Gets current cookies params.
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
	
		// Sets the session name to the one set above.
		session_name($session_name);
        //session_save_path("cgi-bin"); // FOR CHNAGE WHEN UPLOAD TO HOSTING
		session_start();            // Start the PHP session 
		session_regenerate_id();    // regenerated the session, delete the old one. 
	}

	public function register($fname,$lname,$uname,$umail,$upass, $ulevel)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->db->prepare("INSERT INTO users(user_name,user_email,user_pass, u_level) 
		                                               VALUES(:uname, :umail, :upass, :ulevel)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);	
			$stmt->bindparam(":ulevel", $ulevel); 									  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	public function update_user($userid, $uname, $umail, $upass, $ulevel)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->db->prepare("update users set user_name=:uname, user_email=:umail, user_pass=:upass, u_level=:ulevel where user_id=:userid");
			$stmt->execute(array(":uname"=>$uname, ":umail"=>$umail, ":upass"=>$new_password, ":userid"=>$userid, ":ulevel"=>$ulevel));	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	public function login($uname,$umail,$upass)
	{

		try
		{
			$stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:uname OR user_email=:umail LIMIT 1");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			// hash the password			
			if($stmt->rowCount() > 0)
			{
					if ($this->checkbrute($userRow['user_id']) == true) {
						// Account is locked 
						// Send an email to user saying their account is locked 
						return false;
            		} else {
						if(password_verify($upass, $userRow['user_pass'])){
							
								// Get the user-agent string of the user.
								$user_browser = $_SERVER['HTTP_USER_AGENT'];
			
								// XSS protection as we might print this value
								$user_id = preg_replace("/[^0-9]+/", "", $userRow['user_id']);
								$_SESSION['user_id'] = $user_id ;
			
								// XSS protection as we might print this value
								$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $userRow['user_name']);
								$_SESSION['username'] = $username;
								
								
								$_SESSION['login_string'] = hash('sha512', $userRow["user_pass"] . $user_browser);
			
								
								// Login successful. 
								return true;		
						}else{
								// Password is not correct 
                    			// We record this attempt in the database 
								$now = time();
								try{
									$stmt= $this->db->prepare("INSERT INTO login_attempts(user_id, time) 
												VALUES (:user_id, :now)"); 
									$stmt->execute(array(':user_id'=> $userRow["user_id"], ':now'=> $now));
									
								}catch (PDOException $e){
									
									echo $e->getMessage();
									// header("Location: error.php?err=Database error: login_attempts");
									//exit();
								}
							return false;
						}		 	
					}
			}
			//No user exist
			return false;
		}
		catch(PDOException $e)
		{
				echo $e->getMessage();
			 //header("Location: error.php?err=Database error: cannot prepare statement");
        	 //exit();
		}
	}
	
	public function is_loggedin(){
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];

        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        try{
			$stmt = $this->db->prepare("SELECT user_pass 
				      FROM users 
				      WHERE user_id =:user_id LIMIT 1");
            
			// Bind "$user_id" to parameter.
			$stmt->bindparam(":user_id", $user_id);
            $stmt->execute();   // Execute the prepared query.

            if ($stmt->rowCount() == 1) {
                
				// If the user exists get variables from result.
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $login_check = hash('sha512', $result["user_pass"] . $user_browser);

                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                
                // Not logged in 
                return false;
            }
        } catch (PDOException $e){
      
			// Could not prepare statement
            header("Location: ../error.php?err=Database error: cannot prepare statement");
            exit();
        }
    } else {
        // Not logged in 
        
        return false;
    }
}

	
	
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
	
	public function checkbrute($user_id) {
    // Get timestamp of current time 
    $now = time();

    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);

    try{
		$stmt = $this->db->prepare("SELECT time 
                                  FROM login_attempts 
                                  WHERE user_id =:user_id AND time > :valid_attempts");
        // Execute the prepared query. 
        $stmt->execute(array(':user_id'=>$user_id, ':valid_attempts' => $valid_attempts));
        // If there have been more than 5 failed logins 
        if ($stmt->rowCount() > 5) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e){
        // Could not create a prepared statement
        header("Location: error.php?err=Database error: cannot prepare statement");
        exit();
    }
}
}
?>