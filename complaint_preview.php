	<div class="row">
		<div class="columns col-sm-12">
			<?php 
			include_once "backend/process.php";
			$complaint = $model->getComplaintDetailById($_GET['id']);?>
			<table class="table">
				<tbody>
					<tr>
						<td><label>Consumer Name</label></td>
						<td><?= $complaint['consumer_name'];?></td>
					</tr>
					<tr>
						<td><label>Address</label></td>
						<td><?= $complaint['address'];?></td>
					</tr>
					<tr>
						<td><label>Contact Number</label></td>
						<td><?= $complaint['contact_number'];?></td>
					</tr>
					<tr>
						<td><label>Nature of Complaint/Request</label></td>
						<td><?= $complaint['complaint_nature'];?></td>
					</tr>
					<tr>
						<td><label>Date</label></td>
						<td><?= $complaint['complaint_datetime'];?></td>
					</tr>
					<tr>
						<td><label>Type</label></td>
						<td><?= $complaint['type'];?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
