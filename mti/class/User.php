<?php
require_once('../database/Database.php');
require_once('../interface/iUser.php');
class User extends Database implements iUser {

	public function user_login($username, $password)
	{
		$sql = "SELECT * 
			FROM users 
			WHERE email = ?
			and password = ?
			";

		// $sql = "SELECT u.user_id,u.user_type,e.empleado_nombre, e.empleado_cemple, e.empleado_oficina
		// 		FROM user u 
		// 		INNER JOIN empleado e 
		// 		ON u.user_empleado_id = e.empleado_id	
		// 		WHERE u.user_mail = ?
		// 		AND u.user_pass = ?		
		// ";
		
		return $this->getRow($sql, [$username, $password]);
	}//end login_user

	public function insert_Row($uid,$username,$userip,$status)
	{
		$sql = "insert into userlog(uid,username,userip,status) values(?,?,?,?)";
		return $this->insertRow($sql, [$uid,$username,$userip,$status]);
	}

	public function update_Row($ldate,$userip)
	{
		$sql = "UPDATE userlog  SET logout = ? WHERE uid = ? ORDER BY id DESC LIMIT 1";
		return $this->updateRow($sql, [$ldate,$userip]);
	}
}//en class User

$user = new User();

/* End of file User.php */
/* Location: .//D/xampp/htdocs/regis/class/User.php */

