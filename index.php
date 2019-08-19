<?php
define('ROOT', __DIR__);
define('DS', DIRECTORY_SEPARATOR);

require ROOT .DS. 'backend' .DS. 'includes' .DS. 'definitions.php';
require  ROOT .DS. 'WebStore.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
    
<!-- App title -->
<title>Web Store</title>

<!-- App Favicon -->
<link rel="shortcut icon" href="<?php echo RELATIVE_ROOT ?>/client/images/smallwslogo.png">

<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"></link>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="page-header row">
            <div class="col-md-2 pull-left">
                <img width="75%" src="<?php echo RELATIVE_ROOT . '/client/images/wslogo.png' ?>" /> 
            </div>
            <div class="col-md-10 pull-left">
                <h1 style="font-size: 55px; letter-spacing: -3px; padding-top: 20px; margin-left: -60px">
                    <a onclick="window.history.go(-1)" style="color: black">
                        Web Store Administration
                    </a>
                </h1> 
            </div>
        </div>
        <?php
            //initialise the web store
            $sample = new WebStore();
            
            if($sample->checkInstallation()){
                $sample->load($_GET);
            }
        ?>
    </div>
</body>
</html>
