<div class="whitetext">
	<?php
		foreach($files as $v) {
			if(is_dir('./modules/program'.$_GET['link'].'/'.$v)){
				echo '<img src="/img/gnome-fs-directory-6554417720.png"><a href="/index.php?module=program&link='.$_GET['link'].'/'.$v.'" name="">'.$v.'</a><br>';
		} elseif(!is_dir('./modules/program'.$_GET['link'].'/'.$v)) {
				echo '<img src="/img/file-5425619727.png">'.$v.'<br>';
		}
	}
	?>
</div>