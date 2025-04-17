<?php

session_destroy();
header("Location: views/auth/index.view.php");
exit();
