<!DOCTYPE html>
<html lang="en">

<head>
	<style>
		body {
			display: flex;
			flex-wrap: wrap;
			font-family: Arial;
			justify-content: center;
		}

		h3 {
			text-align: center;
			padding: 0 10px;
		}

		.tree {
			margin: 18px;
			padding: 0;
		}

		.tree:not(:empty):before,
		.tree:not(:empty):after,
		.tree ul:not(:empty):before,
		.tree ul:not(:empty):after,
		.tree li:not(:empty):before,
		.tree li:not(:empty):after {
			display: block;
			position: absolute;
			content: "";
		}

		.tree ul,
		.tree li {
			position: relative;
			margin: 0;
			padding: 0;
		}

		.tree li {
			list-style: none;
		}

		.tree li>div {
			background-color: yellow;
			color: #222;
			padding: 5px;
			display: inline-block;
		}

		.tree.cascade li {
			margin-left: 24px;
		}

		.tree.cascade li div {
			margin-top: 12px;
		}

		.tree.cascade li:before {
			border-left: 1px solid black;
			height: 100%;
			width: 0;
			top: 0;
			left: -12px;
		}

		.tree.cascade li:after {
			border-top: 1px solid black;
			width: 12px;
			left: -12px;
			top: 24px;
		}

		.tree.cascade li:last-child:before {
			height: 24px;
			top: 0;
		}

		.tree.cascade>li:first-child:before {
			top: 24px;
		}

		.tree.cascade>li:only-child {
			margin-left: 0;
		}

		.tree.cascade>li:only-child:before,
		.tree.cascade>li:only-child:after {
			content: none;
		}

		.tree.horizontal li {
			display: flex;
			align-items: center;
			margin-left: 24px;
		}

		.tree.horizontal li div {
			margin: 6px 0;
		}

		.tree.horizontal li:before {
			border-left: 1px solid black;
			height: 100%;
			width: 0;
			top: 0;
			left: -12px;
		}

		.tree.horizontal li:first-child:before {
			height: 50%;
			top: 50%;
		}

		.tree.horizontal li:last-child:before {
			height: 50%;
			bottom: 50%;
			top: auto;
		}

		.tree.horizontal li:after,
		.tree.horizontal li ul:after {
			border-top: 1px solid black;
			height: 0;
			width: 12px;
			top: 50%;
			left: -12px;
		}

		.tree.horizontal li:only-child:before {
			content: none;
		}

		.tree.horizontal li ul:after {
			left: 0;
		}

		.tree.horizontal>li:only-child {
			margin-left: 0;
		}

		.tree.horizontal>li:only-child:before,
		.tree.horizontal>li:only-child:after {
			content: none;
		}

		.tree.vertical {
			display: flex;
		}

		.tree.vertical ul {
			display: flex;
			justify-content: center;
		}

		.tree.vertical li {
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		.tree.vertical li div {
			margin: 39px 30px;
		}

		.tree.vertical li:before {
			border-left: 1px solid black;
			height: 12px;
			width: 0;
			top: 0;
		}

		.tree.vertical li:after {
			border-top: 1px solid black;
			height: 0;
			width: 100%;
		}

		.tree.vertical li:first-child:after {
			border-top: 1px solid black;
			height: 0;
			width: 50%;
			left: 50%;
		}

		.tree.vertical li:last-child:after {
			border-top: 1px solid black;
			height: 0;
			width: 50%;
			right: 50%;
		}

		.tree.vertical li:only-child:after {
			content: none;
		}

		.tree.vertical li ul:before {
			border-left: 1px solid black;
			height: 12px;
			width: 0;
			top: -12px;
		}

		.tree.vertical>li:only-child:before,
		.tree.vertical>li:only-child:after {
			content: none;
		}

		.tree .tree.vertical .cascade,
		.tree.vertical .tree .cascade,
		.tree .tree.vertical.cascade-1>li,
		.tree .tree.vertical.cascade-2>li>ul>li,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li {
			flex-direction: column;
			align-items: start;
			padding: 0 12px;
		}

		.tree .tree.vertical .cascade:before,
		.tree.vertical .tree .cascade:before,
		.tree .tree.vertical.cascade-1>li:before,
		.tree .tree.vertical.cascade-2>li>ul>li:before,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li:before,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li:before {
			left: 24px;
		}

		.tree .tree.vertical .cascade:after,
		.tree.vertical .tree .cascade:after,
		.tree .tree.vertical.cascade-1>li:after,
		.tree .tree.vertical.cascade-2>li>ul>li:after,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li:after,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li:after {
			left: 0;
		}

		.tree .tree.vertical .cascade:first-child:after,
		.tree.vertical .tree .cascade:first-child:after,
		.tree .tree.vertical.cascade-1>li:first-child:after,
		.tree .tree.vertical.cascade-2>li>ul>li:first-child:after,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li:first-child:after,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li:first-child:after {
			left: 24px;
			width: 100%;
		}

		.tree .tree.vertical .cascade:last-child:after,
		.tree.vertical .tree .cascade:last-child:after,
		.tree .tree.vertical.cascade-1>li:last-child:after,
		.tree .tree.vertical.cascade-2>li>ul>li:last-child:after,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li:last-child:after,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li:last-child:after {
			left: 0;
			width: 24px;
		}

		.tree .tree.vertical .cascade ul,
		.tree.vertical .tree .cascade ul,
		.tree .tree.vertical.cascade-1>li ul,
		.tree .tree.vertical.cascade-2>li>ul>li ul,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li ul,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li ul,
		.tree .tree.vertical .cascade li,
		.tree.vertical .tree .cascade li,
		.tree .tree.vertical.cascade-1>li li,
		.tree .tree.vertical.cascade-2>li>ul>li li,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li li,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li {
			display: block;
		}

		.tree .tree.vertical .cascade ul:before,
		.tree.vertical .tree .cascade ul:before,
		.tree .tree.vertical.cascade-1>li ul:before,
		.tree .tree.vertical.cascade-2>li>ul>li ul:before,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li ul:before,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li ul:before,
		.tree .tree.vertical .cascade ul:after,
		.tree.vertical .tree .cascade ul:after,
		.tree .tree.vertical.cascade-1>li ul:after,
		.tree .tree.vertical.cascade-2>li>ul>li ul:after,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li ul:after,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li ul:after,
		.tree .tree.vertical .cascade li:before,
		.tree.vertical .tree .cascade li:before,
		.tree .tree.vertical.cascade-1>li li:before,
		.tree .tree.vertical.cascade-2>li>ul>li li:before,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li li:before,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li:before,
		.tree .tree.vertical .cascade li:after,
		.tree.vertical .tree .cascade li:after,
		.tree .tree.vertical.cascade-1>li li:after,
		.tree .tree.vertical.cascade-2>li>ul>li li:after,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li li:after,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li:after {
			border: none;
		}

		.tree .tree.vertical .cascade div,
		.tree.vertical .tree .cascade div,
		.tree .tree.vertical.cascade-1>li div,
		.tree .tree.vertical.cascade-2>li>ul>li div,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li div,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li div {
			margin: 0;
			margin-top: 12px;
		}

		.tree .tree.vertical .cascade li,
		.tree.vertical .tree .cascade li,
		.tree .tree.vertical.cascade-1>li li,
		.tree .tree.vertical.cascade-2>li>ul>li li,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li li,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li {
			margin-left: 24px;
		}

		.tree .tree.vertical .cascade li:before,
		.tree.vertical .tree .cascade li:before,
		.tree .tree.vertical.cascade-1>li li:before,
		.tree .tree.vertical.cascade-2>li>ul>li li:before,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li li:before,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li:before {
			border-left: 1px solid black;
			height: 100%;
			width: 0;
			top: 0;
			left: -12px;
		}

		.tree .tree.vertical .cascade li:after,
		.tree.vertical .tree .cascade li:after,
		.tree .tree.vertical.cascade-1>li li:after,
		.tree .tree.vertical.cascade-2>li>ul>li li:after,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li li:after,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li:after {
			border-top: 1px solid black;
			width: 12px;
			height: 0;
			left: -12px;
			top: 24px;
			content: "";
		}

		.tree .tree.vertical .cascade li:last-child:before,
		.tree.vertical .tree .cascade li:last-child:before,
		.tree .tree.vertical.cascade-1>li li:last-child:before,
		.tree .tree.vertical.cascade-2>li>ul>li li:last-child:before,
		.tree .tree.vertical.cascade-3>li>ul>li>ul>li li:last-child:before,
		.tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li:last-child:before {
			height: 24px;
			top: 0;
		}
	</style>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>homepage here</title>
	<!-- <style>
    body{
        background-color: green;
    }
   </style> -->

</head>

<body>
	<h1>

		<?php
		if (isset($totalreferral)) {


		?>
	</h1>
	<div class="d-flex justify-content-center">
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<div class="row mt-5">
			<div class="col-4">
				<div class="card bg-primary" data-toggle="modal" data-target="#exampleModalCenter" style="cursor:pointer; width: 18rem;">
					<div class="card-body">
						<h5 class="card-title text-center">Your Direct Referral</h5>
						<h3 class="card-text text-center"><?php if ($directreferral <= 0) {
																echo 0;
															} else {
																echo $directreferral;
															} ?></h3>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card bg-info" data-toggle="modal" data-target="#exampleModalCenter" style="cursor:pointer; width: 18rem;">
					<div class="card-body">
						<h5 class="card-title text-center">Your Indirect Referral</h5>
						<h3 class="card-text text-center"><?php if ($indirectreferral <= 0) {
																echo 0;
															} else {
																echo $indirectreferral;
															} ?></h3>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card bg-warning" data-toggle="modal" data-target="#exampleModalCenter" style="cursor:pointer; width: 18rem;">
					<div class="card-body">
						<h5 class="card-title text-center">Your Total Referral</h5>
						<h3 class="card-text text-center"><?php if ($totalreferral <= 0) {
																echo 0;
															} else {
																echo $totalreferral;
															} ?></h3>
					</div>
				</div>
			</div>

		</div>

	</div>

<?php

			// print_r($totalreferral);
		}
		// else {
?>
<div class="container">
	<div class="row">
		<div class="col-12 text-center">
		<form method="post" action="homepage">
			<label> Enter ID To Get Details</label>
	<input type="number" placeholder="Enter ID" value="<?= set_value('id') ?>" name="id">
	<button type="submit" class="btn btn-dark">Submit</button>
</form>
		</div>
	</div>
</div>


<?php
// }

?>
<div class="container d-flex justify-content-center text-center">
	<h4 class="d-flex justify-content-center text-center">

		<?php
		// echo "hirarchy for id ".$id . " is as follows "; 
		?>
	</h4><br><br>


</div>


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="exampleModalLongTitle">Hierarchy View For ID- <?= (isset($id)) ? ($id) : ("no id"); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
				if (isset($tree)) {
					echo  $tree;
				}

				?> </div>
			<!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
		</div>
	</div>
</div>


<div class="container">
	<div class="row">
		<div class="col-12 ">
			<?php 
			if (isset($level)) {
			?>

				<table class="table text-center">
					<thead>
						<tr>
							<th scope="col">Level</th>
							<th scope="col">Total Referrals</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($level as $result) {
						?>

							<tr>
								<th scope="row"><?= $result['level']-1; ?></th>
								<td><?= $result['node_count']; ?></td>

							</tr>
					<?php
						
						}
						?>
				
					</tbody>
				</table>
				<?php
					}
					?>
		</div>
	</div>

</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>