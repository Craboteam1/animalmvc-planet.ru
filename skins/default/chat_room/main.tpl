<?php if(isset($_SESSION['user']) && $_SESSION['user']['access'] == 5) {?>
	<div class="whitetext">
		<div id="manage">
			<div id="user-message"></div>
			<textarea name="message" id="new-message"></textarea>
		</div>
		<div class="chat-window">
			<div class="main-block clearfix" id="chat">
				<?php
				while($row = $messages->fetch_assoc()) {$last_mess_id[] = (int)$row['id'];?>
					<div class="messages" id="mess_<?php echo(int)$row['id'];?>">
						<div class="deleteThis" onclick="deleteThis('<?php echo (int)$row['id'];?>')"><img src="/img/icons8-delete-filled-24.png" name="<?php echo (int)$row['id'];?>" ></div>
						<span style="color: <?php echo $row['access'];?>" class="addressed" id="access_<?php echo (int)$row['id'];?>" onclick="addressedTo('<?php echo spechar($row['name'])?>')"><?php echo spechar($row['name']);?>: </span>
						<div class="text" id="text_<?php echo (int)$row['id'];?>">
							<?php
								$patterns = array(
									'#'.$_SESSION['user']['login'].',#',
									'#T_T\s?#',
									'#:D\s?#',
									'#:3\s?#',
									'#0_O\s?#',
									'#:\)\s?#',
									'#:\(\s?#'
								);
								$replace = array ('<span class="personal-message">'.$_SESSION['user']['login'].',</span>',
									'<img src="/img/icons8-crying-50.png">',
									'<img src="/img/icons8-lol-50.png">',
									'<img src="/img/icons8-in-love-50.png">',
									'<img src="/img/icons8-surprised-50.png">',
									'<img src="/img/icons8-happy-50.png">',
									'<img src="/img/icons8-sad-50.png">'
								);
								echo preg_replace($patterns,$replace,spechar($row['text']));
							 ?>
						</div>
						<div class="manage" onclick="openTab('<?php echo spechar($row['name']);?>','<?php echo spechar($row['access']);?>','<?php echo spechar($row['text']); ?>','<?php echo (int)$row['id']; ?>')"><img src="/img/icons8-redact-50.png"></div>
						<br>
					</div>
				<?php } ?>

			</div>
			<div class="friends-online clearfix">
				Who's Online<br>
				<div class="user" id="users-online">
				</div>
				<div class="user-profile">
					Your profile:<br>
					<span style="color: <?php if($_SESSION['user']['access'] == 4 || $_SESSION['user']['access'] == 5) { echo 'red';} else { echo 'blue';}?>" id="y">
					  <?php if(isset($_SESSION['user']) && $_SESSION['user']['active'] == 1) { echo trim(spechar($_SESSION['user']['login']));}?>
				</span>
					<?php
					if(isset($_SESSION['user']) && $_SESSION['user']['active'] == 1) {
						if($_SESSION['user']['access'] == 4 || $_SESSION['user']['access'] == 5) {
							echo '<img src="/img/moderator-icon.png"><br>';
						}
						else {
							echo '<img src="/img/user-icon.png">';
						}
					} else {
						echo 'Авторизируйтесь, чтобы  общаться в чате';
					}
					?>
				</div>
			</div>
			<div class="text-input">
				<form method="post" action="/modules/chat_room/add.php" onsubmit="return addMessage('<?php echo trim(spechar($_SESSION['user']['login']))?>')">
					<textarea name="mess" id="x"></textarea>
					<input type="submit" name="submit">
				</form>

				<div id="error"></div>
			</div>
			<div class="smiles">
				<img src="/img/icons8-happy-50.png"  onclick="emoji('happy')">
				<img src="/img/icons8-lol-50.png"  onclick="emoji('lol')">
				<img src="/img/icons8-in-love-50.png"  onclick="emoji('love')">
				<img src="/img/icons8-sad-50.png"  onclick="emoji('sad')">
				<img src="/img/icons8-crying-50.png"  onclick="emoji('cry')">
				<img src="/img/icons8-surprised-50.png"  onclick="emoji('wow')">
			</div>
		</div>
	</div>
	<script>
		var current_user_name = '<?php echo trim(spechar($_SESSION['user']['login']))?>';
		var last_comm_id = '<?php echo $last_mess_id[0];?>';
		var user_access = '<?php echo (int)$_SESSION['user']['access']?>';
		var last_log_id = '<?php
			$ids1 = $logs->fetch_assoc();
			echo $ids1['id'];
			?>';
	</script>
<?php } elseif(isset($_SESSION['user']) && $_SESSION['user']['access'] != 5 && $_SESSION['user']['active'] == 1) {?>
	<div class="whitetext">
		<div id="manage">
			<div id="user-message"></div>
			<textarea name="message" id="new-message"></textarea>
		</div>
		<div class="chat-window">
			<div class="main-block clearfix" id="chat">
				<?php
				while($row = $messages->fetch_assoc()) {$last_mess_id[] = (int)$row['id'];?>
					<div class="messages" id="mess_<?php echo (int)$row['id'];?>">
						<span style="color: <?php echo $row['access'];?>" class="addressed" id="access_<?php echo (int)$row['id'];?>" onclick="addressedTo('<?php echo spechar($row['name'])?>')"><?php echo spechar($row['name']);?>: </span>
						<div id="text_<?php echo (int)$row['id'];?>" class="text">
							<?php
							$patterns = array(
							'#'.$_SESSION['user']['login'].',#',
							'#T_T\s?#',
							'#:D\s?#',
							'#:3\s?#',
							'#0_O\s?#',
							'#:\)\s?#',
							'#:\(\s?#'
							);
							$replace = array ('<span class="personal-message">'.$_SESSION['user']['login'].',</span>',
							'<img src="/img/icons8-crying-50.png">',
							'<img src="/img/icons8-lol-50.png">',
							'<img src="/img/icons8-in-love-50.png">',
							'<img src="/img/icons8-surprised-50.png">',
							'<img src="/img/icons8-happy-50.png">',
							'<img src="/img/icons8-sad-50.png">'
							);
							echo preg_replace($patterns,$replace,spechar($row['text']));
							?>
						</div>
						<br>
					</div>
				<?php } ?>

			</div>
			<div class="friends-online clearfix">
				Who's Online<br>
				<div class="user" id="users-online">
				</div>
				<div class="user-profile">
					Your profile:<br>
					<span style="color: <?php if($_SESSION['user']['access'] == 4 || $_SESSION['user']['access'] == 5) { echo 'red';} else { echo 'blue';}?>" id="y">
					  <?php if(isset($_SESSION['user']) && $_SESSION['user']['active'] == 1) { echo spechar($_SESSION['user']['login']);}?>
				</span>
					<?php
					if(isset($_SESSION['user']) && $_SESSION['user']['active'] == 1) {
						if($_SESSION['user']['access'] == 4 || $_SESSION['user']['access'] == 5) {
							echo '<img src="/img/moderator-icon.png"><br>';
						}
						else {
							echo '<img src="/img/user-icon.png"><br>';
						}
					} else {
						echo 'Авторизируйтесь, чтобы  общаться в чате';
					}
					?>
				</div>
			</div>
			<div class="text-input">
				<form method="post" action="/modules/chat_room/add.php" onsubmit="return addMessage('<?php echo trim(spechar($_SESSION['user']['login']))?>')">
					<textarea name="mess" id="x"></textarea>
					<input type="submit" name="submit">
				</form>

				<div id="error"></div>
			</div>
			<div class="smiles">
				<img src="/img/icons8-happy-50.png" onclick="emoji('happy')">
				<img src="/img/icons8-lol-50.png" onclick="emoji('lol')">
				<img src="/img/icons8-in-love-50.png" onclick="emoji('love')">
				<img src="/img/icons8-sad-50.png" onclick="emoji('sad')">
				<img src="/img/icons8-crying-50.png" onclick="emoji('cry')">
				<img src="/img/icons8-surprised-50.png" onclick="emoji('wow')">
			</div>
		</div>
	</div>

	<script>
		var current_user_name = '<?php echo trim(spechar($_SESSION['user']['login']))?>';
		var last_comm_id = '<?php echo $last_mess_id[0];?>';
		var user_access = '<?php echo (int)$_SESSION['user']['access']?>';
		var last_log_id = '<?php
		$ids1 = $logs->fetch_assoc();
		echo $ids1['id'];
		?>';
	</script>
<?php } else { echo '<div class="whitetext">Авторизируйтесь чтобы получить доступ в чат</div>';} ?>