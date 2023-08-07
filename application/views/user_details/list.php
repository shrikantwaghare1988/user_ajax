
<!DOCTYPE html>
<html>
<head>
    <title>CodeIgniter Employee CRUD Operation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/js/bootstrap.min.js" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h2 class="text-center mt-5 mb-3"><?php echo $title; ?></h2>
		<div class=" mb-3 col-xs-3">
			<button type="button" class="btn btn-primary start">Start</button>
			<button type="button" class="btn btn-secondary stop">Stop</button>
			<button type="button" class="btn btn-success resume">Resume</button>
			<button type="button" class="btn btn-danger">Danger</button>
		</div>
<div class="card">
    <div class="card-header">
    	<div class=" mb-3 mt-3 col-xs-3">
        <span class="alert alert-primary" role="alert">Total Request - <span id="request_count">0</span></span>
        
        <span class="alert alert-success" role="alert">Total Completed - <span id="completed_count">0</span></span>

        <span class="alert alert-success" role="alert">Diff - <span id="diff_count">0</span></span>
       	</div>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('success')) {?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>
 
        <table class="table table-bordered">
            <tr>
            	<th>ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Ajax Status</th>               
            </tr>
 
            <?php foreach ($users as $e) { ?>      
            <tr>
            	<td><?php echo $e['user_id']; ?></td>
                <td><?php echo $e['username']; ?></td>
                <td><?php echo $e['first_name']; ?></td>
                <td><?php echo $e['last_name']; ?></td>
                <td><?php echo $e['gender']; ?></td>
                <td>
                	<span class="status badge badge-<?php echo $e['status'] == '1' ? 'success':'danger' ?>" data-user_id="<?php echo $e['user_id']; ?>">Success</span>                	
                </td>
                <td>
                	<span class="final_status" id="final_status_<?php echo $e['user_id']; ?>">Pending</span>               	
                </td>  

            </tr>
            <?php } ?>
        </table>
    </div>
</div>

	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script>
		$(document).ready(function()
		{
			var arr = [];
    // Loop through each div element with the class box
    $(".status").each(function(){
        // Test if the div element is empty
        var a =$(this).attr('data-user_id');
        arr.push(a);
    });

    var c =0;
    var c1 =0;
    var flag = 1;

    //$("#final_status_1").html("Done");

    $(".stop").click(function()
    {
    	flag = 0;
    });
    $(".start").click(function()
    {
    	flag = 1;
        setInterval(function() 
    	{ 
    		console.log("Flag val "+flag);
 			if(flag == 1 &&  arr.length > c)
 			{
 				var user_id = arr[c];

 				console.log("User id "+user_id);
 				flag == 0;
 				c++;

	 			$("#request_count").html(c);

	 			$.ajax({        
				        url: "<?php echo base_url('User_details/ajax_update');?>", 
				        type: "POST",
				        data:  {'id':user_id},			       

				        success: function (res) {          
				          if(res == "ok")
				          {
				          	c1++;
				          	$("#completed_count").html(c);

				          	$("#final_status_"+user_id).text("Done");
				            console.log("Record Saved Successfully");
				            flag == 1;			            
				          }
				          else
				          {
				          	flag == 0;
				          	console.log("Fail");
				          }				         
				        }
				      });

	 			$("#diff_count").html(c-c1);
	 			}

		}, 50); // 5000 milliseconds
    }); 

    	
  	
	

    //console.log(arr);
});
</script>
</body>
</html>