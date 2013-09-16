<?php
// application/controllers/account.php
class Account_Controller extends Base_Controller
{
	public function action_index()
	{
		echo "This is the profile page.";
	}
	public function action_login()
	{
		echo "This is the login form.";
	}
	public function action_logout()
	{
		echo "This is the logout action.";
	}
}