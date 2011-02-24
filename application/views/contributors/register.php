<?php $this->load->view('global/_new_header.php'); ?>

<h2>Register</h2>

<p>Hook us up with some registration information, and we'll let you come on inside and start sparkin' up the place! (However, pyro's are encouraged to check their lighters at the door. Thx - "the Mgmt")</p>

<div class="form-wrapper">
	<form action="/register" id="register" method="post">
		<fieldset>
			<label for="username">User Name:</label><br class="clear" />
			<input type="text" id="username" name="username" class="text-box" /><br class="clear" />
			<label for="email">Email Address:</label><br class="clear" />
			<input type="text" id="email" name="email" class="text-box" /><br class="clear" />
			<label for="password">Password:</label><br class="clear" />
			<input type="password" id="password" name="password" class="text-box" /><br class="clear" />
			<label for="password_again">Confirm Password:</label><br class="clear" />
			<input type="password" id="password_again" name="password_again" class="text-box" /><br class="clear" />
			<label for="real_name">Full Name:</label><br class="clear" />
			<input type="text" id="real_name" name="real_name" class="text-box" /><br class="clear" />
			<label for="website">Web Site:</label><br class="clear" />
			<input type="text" id="website" name="website" class="text-box" /><br class="clear" />
			<label for="spam_check_answer">Robot Check:</label>&nbsp;&nbsp;<span class="robot-question"><?=$spam_question;?></span><br class="clear" />
			<input type="text" id="spam_check_answer" name="spam_check_answer" class="text-box" /><br class="clear" />
			<input type="submit" name="submit" value="Register" class="button" />
		</fieldset>
	</form>
</div>

<?php $this->load->view('global/_new_footer.php'); ?>