<?php
// application/controllers/account.php
class AccountController extends BaseController
{
	public function showIndex()
	{
		echo "This is the profile page.";
	}
	public function showLogin()
	{
		echo "This is the login form.";
	}
	public function showLogout()
	{
		echo "This is the logout action.";
	}
}