<?php
session_destroy();
setcookie('hash','',time() - 3600,'/');
setcookie('id','',time() - 3600,'/');
header("Location: /");
exit();
