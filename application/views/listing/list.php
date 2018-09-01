<!DOCTYPE html>
<html>
<head>
	<title>Listing</title>
	<link rel="stylesheet"

		  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
</head>
<body>
<div class="container">
	<table class="table wy-table-bordered-rows">
		<tr>
			<td><strong>List Name</strong></td>
			<td><strong>Distance</strong></td>
			<td><strong>Action</strong></td>
		</tr>
		<?php foreach($list as $item){?>
			<tr>
				<td><?php echo $item->list_name;?></td>
				<td><?php echo $item->distance;?></td>
				<td><a href="<?php echo base_url() . "user/delete_list/" . $item->id; ?>"><button>Delete</button></a></td>
			</tr>
		<?php }?>
	</table>


</div>
</body>
</html>
