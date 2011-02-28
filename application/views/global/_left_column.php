<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$("#lazy_profile").load("/contributors/get_profile_info");
	});
</script>

<?php

$this->load->model('spark');
$featured_sparks = Spark::getLatestOf(3, TRUE);
$official_sparks = Spark::getLatestOf(3, NULL, TRUE);

?>

<div class="page-left">
	
	<div class="login-box clearfix">
		
		<?php if (!UserHelper::isLoggedIn()): ?>
			<form action="/login" method="post">
				<fieldset>
					<label for="email">Email Address:</label><br class="clear" />
					<input type="text" id="email" name="email" class="text-box" /><br class="clear" />
					<label for="password">Password:</label><br class="clear" />
					<input type="password" id="password" name="password" class="text-box" /><br class="clear" />
					<input type="submit" id="submit" class="submit" value="Login">
				</fieldset>
			</form>
		<?php else: ?>
			<div id="lazy_profile"></div>
		<?php endif; ?>
		
	</div>
	
	<?php if (isset($official_sparks)): ?>
	<div class="info-box clearfix">
		<h2>Official Sparks</h2>
		<ul>
			<?php foreach ($official_sparks as $spark): ?>
			<li class="clearfix">
				<a style="font-size:16px;" href="<?php echo base_url(); ?>packages/<?php echo $spark->name; ?>/versions/HEAD/show"><img src="<?php echo Gravatar_helper::from_email($spark->email, null, 40); ?>" /></a>
				<p class="no-margin">
					<a style="font-size:16px;" href="<?php echo base_url(); ?>packages/<?php echo $spark->name; ?>/versions/HEAD/show"><?php echo $spark->name; ?></a><br />
					by: <a href="<?php echo base_url(); ?>contributors/<?php echo $spark->username; ?>/profile"><?php echo $spark->username; ?></a>
				</p>
				<br class="clear" />
				<p class="no-margin"><em><?php echo $spark->summary; ?></em></p>
			</li>
			<?php endforeach; ?>
			<li class="last"><a href="<?php echo base_url(); ?>packages/browse/official">View All Official Sparks</a></li>
		</ul>
	</div>
	<?php endif; ?>
	
	<?php if (isset($featured_sparks)): ?>
	<div class="info-box clearfix">
		<h2>Featured Sparks</h2>
		<ul>
			<?php foreach ($featured_sparks as $spark): ?>
			<li class="clearfix">
				<a style="font-size:16px;" href="<?php echo base_url(); ?>packages/<?php echo $spark->name; ?>/versions/HEAD/show"><img src="<?php echo Gravatar_helper::from_email($spark->email, null, 40); ?>" /></a>
				<p class="no-margin">
					<a style="font-size:16px;" href="<?php echo base_url(); ?>packages/<?php echo $spark->name; ?>/versions/HEAD/show"><?php echo $spark->name; ?></a><br />
					by: <a href="<?php echo base_url(); ?>contributors/<?php echo $spark->username; ?>/profile"><?php echo $spark->username; ?></a>
				</p>
				<br class="clear" />
				<p class="no-margin"><em><?php echo $spark->summary; ?></em></p>
			</li>
			<?php endforeach; ?>
			<li class="last"><a href="<?php echo base_url(); ?>packages/browse/featured">View All Featured Sparks</a></li>
		</ul>
	</div>
	<?php endif; ?>
		
</div>