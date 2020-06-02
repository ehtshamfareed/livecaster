<?php include './req/setting.php'; ?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title><?php echo $_SESSION['title']; ?></title>
<link rel="shortcut icon" type="image/x-icon" href="data:image;base64,<?php echo base64_encode( $_SESSION['icon']); ?>" />
</head>

<?php

require 'header.php';
require 'footer.php';
?>