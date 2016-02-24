<?php 
	include_once "backend/process.php";
	$list = $model->getComplaintExport();

?>
<link href="css/bootstrap.min.css" rel="stylesheet">

<div class="container">
	<table data-form="information sheet" class="table">
		<thead>
			<tr>
				<th colspan="9" style="text-align:center;">
					<img width="50" src="img/logo.png">
					<h1>MARINDUQUE ELECTRIC COOPERATIVE, INC</h1>
					<h2>(MARELCO)</h2>
					<p>Boac, Marinduque</p>
					<p>CONSUMER COMPLAINTS LOGBOOK</p>
					<p>(CWD Monitoring Report)</p>
					<br>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Name of Consumer</td>
				<td>Address</td>
				<td>Contact Number</td>
				<td>Nature of Complaint</td>
				<td>Date & Time Receipt of Complaints</td>
				<td>Action Desired</td>
				<td>Action Taken</td>
				<td>Date & Time of Action</td>
				<td>Accomplished getUserById</td>
			</tr>
			<?php foreach($list as $idx => $u): ?>
                <tr>
                  <td><?= $u['consumer_name'];?></td>
                  <td><?= $u['address'];?></td>
                  <td><?= $u['contact_number'];?></td>
                  <td><?= $u['complaint_nature'];?></td>
                  <td><?= $u['complaint_datetime'];?></td>
                  <td><?= $u['action_desired'];?></td>
                  <td><?= $u['action_taken'];?></td>
                  <td><?= $u['action_datetime'];?></td>
                  <td><?= $u['firstname'].' '. $u['lastname'];?></td>
                </tr>
                <?php endforeach ?>
		</tbody>
	</table>
</div>
	