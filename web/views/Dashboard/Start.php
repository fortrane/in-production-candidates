<?php
$templates = new Templates();

$templates->documentHead("Dashboard");
?>
<body>
    <?php 
    $templates->inProdHeader("Start"); 
    $templates->inProdStart();
    $templates->inProdFooter();
    $templates->documentJavascript("Start");
    ?>
</body>
</html>