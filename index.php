<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

</head>
<body>



	<!-- Include all the scripts here -->
	<script src = "http://d3js.org/d3.v3.min.js"></script>
	<script type="text/javascript">

	var width = 1100,
	height = 800

	var svg = d3.select("body").append("svg")
	.attr("width", width)
	.attr("height", height);

	var force = d3.layout.force()
	.gravity(.05)
	.distance(150)
	.charge(-100)
	.size([width, height]);

	d3.json("data/data.json", function(error, json) {
		force
		.nodes(json.nodes)
		.links(json.links)
		.start();

		var link = svg.selectAll(".link")
		.data(json.links)
		.enter()
		.append("line")
		.attr("class","link");

		var node = svg.selectAll(".node")
		.data(json.nodes)
		.enter()
		.append("g")
		.attr("class", "node")
		.call(force.drag);

		node.append("circle")
		.attr("r", 6);

		node.append("text")
		.attr("dx", 12)
		.attr("dy", ".35em")
		.text(function(d) { return d.name });

		force.on("tick", function() {
	    	link.attr("x1", function(d) { return d.source.x; })
	        .attr("y1", function(d) { return d.source.y; })
	        .attr("x2", function(d) { return d.target.x; })
	        .attr("y2", function(d) { return d.target.y; });

    	node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; 
    });
    });

	});



	</script>
</body>
</html>