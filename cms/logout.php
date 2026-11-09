<?php
require_once __DIR__ . '/auth.php';
cms_logout();
header('Location: /cms/login.php');
exit;
