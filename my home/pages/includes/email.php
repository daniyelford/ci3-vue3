<?php if(!empty($x) && is_string($x)){ echo $x; }else{ ?>
<html>
<head>
</head>
<body>
    <?php if(!empty($data)) {
        if(is_string($data)){echo $data;}elseif(is_array($data)){}
    }else{
        if(!empty($text)) if(is_string($text))echo $text; 
    } ?>
</body>
</html>
<?php } ?>