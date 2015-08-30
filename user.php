<?php 
$user = array();
if($_GET['id']){

	$id = $_GET['id'];

$feed2 = file_get_contents('http://api.stackexchange.com/2.2/users/'.$id.'/top-answer-tags?page=1&pagesize=5&site=stackoverflow');
 $feed2 = gzinflate(substr($feed2, 10, -8));
 $feed2 = json_decode($feed2,true);

for($a=0;$a<5;$a++) {
	 $user[$id][$a] = $feed2['items'][$a]['tag_name'];
	 $tag[$id][$a] = $feed2['items'][$a]['answer_score'];
}

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

<script type="text/javascript" src='js/Chart.min.js'></script>
	
	<script>
	var pieData = [
				{
					value: <?php echo $tag[$id][0] ?>,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "<?php echo $user[$id][0] ?>"
				},
				{
					value: <?php echo $tag[$id][1] ?>,
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "<?php echo $user[$id][1] ?>"
				},
				{
					value: <?php echo $tag[$id][2] ?>,
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "<?php echo $user[$id][2] ?>"
				},
				{
					value: <?php echo $tag[$id][3] ?>,
					color: "#949FB1",
					highlight: "#A8B3C5",
					label: "<?php echo $user[$id][3] ?>"
				},
				{
					value: <?php echo $tag[$id][4] ?>,
					color: "#4D5360",
					highlight: "#616774",
					label: "<?php echo $user[$id][4] ?>"
				}

			];

			window.onload = function(){
				var ctx = document.getElementById("chart-area").getContext("2d");
				window.myPie = new Chart(ctx).Pie(pieData);
			};


	
	</script>
</head>
<body>
<div id="wrapper1">
	<div id="wrapper3">
		<div id="portfolio" class="container">
			<div class="title">
				<h2>User ID : <?php echo $id; ?></h2>
				

				
				<div class="column1">
					<div class="box">
						
						<h3>Tag Name :<br>
							<ul><?php 
				$d=1;
				foreach ($user as $key) { ?><li>
				 <?php foreach ($key as $key2) { echo $key2."<br/>";	} ?></li>
				<?php  } ?></ul></h3>

					</div>
		</div>
	</div>
</div>
<div id="footer" class="container">
	 <div class="title">

<div id="canvas-holder">

			<canvas id="chart-area" width="300" height="300"/>
		</div>
</body>
</html>
