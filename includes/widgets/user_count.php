<div class="widget">
    <h2>Users</h2>
    <div class="inner">
		<?php
		$user_count = user_count();
		$suffix = ($user_count != 1) ? 's' : '';
		?>
		We currently have <b><?php echo $user_count; ?></b> registered user<?php echo $suffix; ?>.
		<br>We currently have <b>0</b> open slots.
    </div>
</div>