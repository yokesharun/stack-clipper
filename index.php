<?php 

$tags_name = array('JAVA','C','PHP','PYTHON','JQUERY','ANDROID','JAVASCRIPT');

$array = array();

foreach ($tags_name as $value) {

$feed = file_get_contents('http://api.stackexchange.com/2.2/tags/'.$value.'/info?order=desc&sort=popular&site=stackoverflow');
$feed = gzinflate(substr($feed, 10, -8));
$feed = json_decode($feed,true);

array_push($array, $feed['items'][0]['count']);
}

$feed1 = file_get_contents('http://api.stackexchange.com/2.2/users/moderators?page=1&pagesize=5&order=desc&sort=reputation&site=stackoverflow');
$feed1 = gzinflate(substr($feed1, 10, -8));
$feed1 = json_decode($feed1,true);
//print_r($feed);

$user = array();
$tag = array();

//$store = $feed['items'][0]['user_id'];

for($a=0;$a<5;$a++) {
	$user[$a]['user_id'] = $feed1['items'][$a]['user_id'];
	$user[$a]['name'] = $feed1['items'][$a]['display_name'];
	$user[$a]['image'] = $feed1['items'][$a]['profile_image'];
	$user[$a]['rep'] = $feed1['items'][$a]['reputation'];
}

 ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />

<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
<script type="text/javascript" src='jquery.js'></script>
<script type="text/javascript" src='js/Chart.min.js'></script>
	<script>
	//var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		labels : ['JAVA','C','PHP','PYTHON','JQUERY','ANDROID','JAVASCRIPT'],
		datasets : [
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data : [<?php foreach($array as $count) { echo $count.',';} ?>]
			}
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	}

	</script>
</head>
<body>
<div id="wrapper1">
	<div id="header-wrapper">
		<div id="header" class="container">
			<div id="logo"> <span class="icon icon-stack-overflow"></span>
				<h1><a href="#">Stack Overflow</a></h1>
				 </div>
			
		</div>
	</div>
	
	
	<div id="wrapper3">
		<div id="portfolio" class="container">
			<div class="title">
				<h2>Top Users IN Stackoverflow </h2>
				<span class="byline">based on Reputation</span> </div>

				<?php $d=1;
				foreach ($user as $key) { ?>
				<div class="column<?php echo $d;?>">
					<div class="box">
						<!-- <span class="icon icon-wrench"></span> -->
						<img src="<?php echo $key['image']; ?>"><br><br>
						<h3>Username : <?php echo $key['name']; ?></h3>
						<p>Reputation: <?php echo $key['rep']; ?></p>
						<a href="user.php?id=<?php echo $key['user_id']; ?>" class="button button-small">More Details !!</a> </div>
					</div>
				<?php $d++;} ?>
			
			
		</div>
	</div>
</div>
<div id="footer" class="container">
	 <div class="title">
		<h2>Overall Usage of Tags in Stackoverflow</h2>
		<span class="byline"></span> </div>
	
</div>
<div style="width: 50%; margin:0 auto;">
			<canvas id="canvas" height="450" width="800"></canvas>
		</div>
<div id="copyright" class="container">
	<p>Stackoverflow</p>
</div>
</body>
</html>
