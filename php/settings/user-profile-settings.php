<?php
	require "../db.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="../../style/user-profile-settings-style.css"/>
		<title>Your Profile</title>
	</head>
	<body>
		<div class="header-wrapper">
			<header class="header-container">
				<div class="header-item">
					<a class="hamburger-wrapper-ref" href="/">
						<div class="hamburger">
							<div class="ham1"></div>
							<div class="ham2"></div>
							<div class="ham3"></div>
						</div>
					</a>
				</div>
				<div class="header-item">
					<a class="header-title" href="/profile.php">TeeMate</a>
				</div>
				<div class="header-item center-item"></div>
				<div class="header-item">
					<a href="">🔔</a>
				</div>
				<div class="header-item relative">
					<details class="details-overlay details-reset">
						<summary class="details-header">
							<img class="user-avatar" alt="@<?php echo $_SESSION['logged_user']->login; ?>" src="../../img/Flying-Penguin.jpg" width="20px" height="20px">
							<span class="dropdown-caret"></span>
						</summary>
						<div class="dropdown-menu" style="width: 180px;">
							<div class="header-nav-current-user">
								<div class="current-user">Signed in as <?php echo "<strong>" . $_SESSION['logged_user']->login . "</strong>"; ?></div>
							</div>
							<hr></hr>
							<a class="dropdown-item" href="../profile.php"><span class="menu-item-ico" style="width: 21px">🏠</span>Profile</a>
							<hr></hr>
							<a class="dropdown-item" href=""><span class="menu-item-ico" style="width: 21px">⚙️</span>Settings</a>
							<a class="dropdown-item" href=""><span class="menu-item-ico" style="width: 21px">❓</span>Help</a>
							<hr></hr>
							<a class="dropdown-item" href="../login/signout.php"><span class="menu-item-ico" style="width: 21px">🚪</span>Sign out</a>
						</div>
					</details>
				</div>
			</header>
		</div>
		<div class="main-wrapper">
			<main class="main-container">
				<div class="page-content">
					<div class="menu-container">
						<nav class="menu">
							<div class="menu-header">
								<img class="user-avatar" alt="@<?php echo $_SESSION['logged_user']->login; ?>" src="../../img/Flying-Penguin.jpg" width="32px" height="32px">
								<div class="user-names">
									<div class="user-name"><?php echo $_SESSION['logged_user']->login; ?></div>
									<div class="normal-text">Personal settings</div>
								</div>
							</div>
							<a class="menu-item selected" href="">Profile</a>
							<a class="menu-item" href="user-account-settings.php">Account</a>
							<a class="menu-item" href="user-security-settings.php">Security</a>
							<a class="menu-item" href="user-emails-settings.php">Emails</a>
						</nav>
					</div>
					<div class="user-settings">
						<div class="user-settings-header">
							<h2 class="settings-subhead">Profile</h2>
							<?php
								$data = $_POST;
								
								if(isset($data['do_saving'])) {
									$findUser = R::findOne('users', 'id = ?', array($_SESSION['logged_user']->id));
									$user_settings = R::load('users', $findUser->id);

									if($findUser->user_name == NULL && $data['user_name'] == ' ') {
										$user_settings->user_name = ' ';
									} else { 
										$user_settings->user_name = $data['user_name']; 
									}
									if($findUser->user_bio == NULL && $data['user_bio'] == ' ') {
										$user_settings->user_bio = ' ';
									} else { 
										$user_settings->user_bio = $data['user_bio'];
									}
									if($findUser->user_location == NULL && $data['user_location'] == ' ') {
										$user_settings->user_location = ' ';
									} else { 
										$user_settings->user_location = $data['user_location'];
									}
		
									R::store($user_settings);
									echo '<div class="form-save-message">Сохранено</div>';
								}
								
								$findUser = R::findOne('users', 'id = ?', array($_SESSION['logged_user']->id));
							?>
						</div>
						<div class="profile-settings">
							<div class="settings-profile-content">
								<form action="user-profile-settings.php" method="POST">
									<div>
										<dl class="form-group">
											<dt>
												<label>Name</label>
											</dt>
											<dd>
												<input class="form-control" type="text" name="user_name" value="<?php echo @$findUser->user_name; ?>">
												<div class="note">note</div>
											</dd>
										</dl>
										<dl class="form-group">
											<dt>
												<label>Bio</label>
											</dt>
											<dd class="user-profile-bio-container">
												<div class="textarea-wrapper">
													<textarea class="form-control" name="user_bio" maxlength="160"><?php echo @$findUser->user_bio; ?></textarea>
												</div>
												<div class="note">note</div>
											</dd>
										</dl>
										<hr></hr>
										<dl class="form-group">
											<dt>
												<label>Location</label>
											</dt>
											<dd>
												<input class="form-control" type="text" name="user_location" value="<?php echo @$findUser->user_location; ?>">
												<div class="note">note</div>
											</dd>
										</dl>
										<button class="submit-button-primary" type="submit" name="do_saving">Сохранить</button>
									</div>
								</form>
							</div>
							<div class="settings-content-avatar">
								<dl class="form-group">
									<dt>
										<label class="avatar-label">Profile picture</label>
									</dt>
									<dd class="avatar-upload">
										<img class="user-avatar" alt="@<?php echo $_SESSION['logged_user']->login; ?>" src="../../img/Flying-Penguin.jpg" width="200px" height="200px">
										<div class="user-avatar-edit">Change avatar</div>
									</dd>
								</dl>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</body>
</html>