<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=1024" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>阅读流模式</title>
    
    <meta name="description" content="impress.js is a presentation tool based on the power of CSS3 transforms and transitions in modern browsers and inspired by the idea behind prezi.com." />
    <meta name="author" content="Bartek Szopka" />

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:regular,semibold,italic,italicsemibold|PT+Sans:400,700,400italic,700italic|PT+Serif:400,700,400italic,700italic" rel="stylesheet" />

    <link href="/script/impress-demo.css" rel="stylesheet" />
    <link href="/script/bootstrap.css" rel="stylesheet" />
    
    <link rel="shortcut icon" href="favicon.png" />
</head>

<body class="impress-not-supported">

<!--<a style="position: fixed; right: 10px; bottom: 10px; padding: 10px;"></a>-->
<div class="fallback-message">
    <p>抱歉，你的浏览器不支持阅读流功能。</p>
    <p>为了更佳的体验，请使用最新的 <b>Chrome</b>, <b>Safari</b> or <b>Firefox</b> 浏览器。</p>
</div>

<div id="impress">

    <?php 
    	$counter = 0;
    	foreach ( $note['note'] as $note_item): 
    ?>
        <div class="step slide" data-x="<?php echo($counter*800-1000) ?>" data-y="-1500" data-z="<?php echo($counter*300) ?>">
	        <strong style="color: #0088D0;">
	        	<?php echo date('Y-m-d',strtotime( $note_item['note_date'])) ?>
	        </strong>
	        <br />
    		<?php echo $note_item['note_content'] ?>
    		<br /><br />
    		<a class="pull-right btn" style="width: 200px; font-size: 16px;" href="/index.php/square/readnote/<?php echo $note['book_info'][0]['book_id']?>/<?php echo $owner_id?>">退出阅读流</a>   		
    	</div>
        
    <?php
        $counter++; 
        endforeach 
    ?>
    
</div>



<div class="hint">
    <p>Use a spacebar or arrow keys to navigate</p>
</div>
<script>
if ("ontouchstart" in document.documentElement) { 
    document.querySelector(".hint").innerHTML = "<p>Tap on the left or right to navigate</p>";
}
</script>

<script src="/script/impress.js"></script>
<script>impress().init();</script>


</body>
</html>


