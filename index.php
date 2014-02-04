<script src='jquery.js'></script>

<script>
	DB = {
		get : function(srv) {
			$.getJSON(srv + ".php").success(function(data) {
				if (srv == 'product') {
					Render.product(data);
				} else {
					Render.user(data);
				}
			});
		},

		del : function(srv) {
			$.ajax({
				url: srv + ".php?id=" + $('#userId').val(),
				type: "DELETE"
			}).done( function(data) {
				//console.log(data);
				alert("User " + data + " was deleted from database");
			});
		}, 

		save : function(srv) {
			$.ajax({
				url: srv + ".php",
				data: {"name" : $("#addFirst").val() },
				type: "POST"
			}).done( function(data) {
				console.log(data);
			});
		},

		update : function(srv) {
			$.ajax({
				url: srv + ".php",
				type: "POST",
				data: {"id" : $("#upId").val(), "name" : $("#upFirst").val() }
			}).done( function(data) {
				console.log(data);
			});
		}
	};

	Render = {
		user : function(data) {
			console.log(data);
		},

		product: function(data) {
			for (var i=0; i<data.length; i++) {
				$('#product').append('<li>' + data[i].description + '(' + data[i].price + ')</li>');
			}
		}
	}
</script>

<body>
	<button onclick="DB.get('user')">Get Customers</button> <br />
	<button onclick="DB.del('user')">Delete Customer</button> Id:<input type='text' id='userId' /> <br />
	<button onclick="DB.update('user')">Update Customer</button> Id:<input type='text' id='upId' /> First:<input type-'text' id='upFirst' /> <br />
	<button onclick="DB.save('user')">Create Customer</button> First:<input type='text' id='addFirst' /> <br />

	<hr />
	<button onclick="DB.save('product')">Create Product</button> Description:<input type='text' id='description' />  Price <input type='text' id='price' /><br />
	<button onclick="DB.get('product')">Load Products</button> 
	<div id='product'></div>
</body>
