			</div>
			<br class="clear" />
		</div>
	</div>
	
	<div id="footer">
		<div class="wrapper">
			<p>
				<a href="/" title="Home">Home</a> | 
				<a href="/about" title="About">Why</a> | 
				<a href="/install" title="Install">Install</a> | 
				<a href="/register" title="Register">Register</a> | 
				<a href="/privacy" title="Home">Privacy</a> | 
				<a href="/contact" title="Home">Contact</a>
			</p>
			<p>
				&copy; 2011 GetSparks.org Team
			</p>
		</div>
	</div>
    <?php if(config_item('is_production')): ?>
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-21216385-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>
    <?php endif; ?>

</body>
</html>