<?php 
	include_once "backend/process.php";
	$list = $model->getAllApplicants();

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
					<p>List of Applicants For Inspection</p>
					<br>
				</th>
			</tr>
		</thead>
      <tbody>
      	<tr>
         <td>Name of Applicant</td>
         <td>Address</td>
         <td>Email</td>
         <td>Date Registered</td>
        </tr>
        <?php foreach($list as $idx => $u): ?>
        <tr>
          <td><?= $u['firstname'].' '. $u['lastname'];?></td>
          <td><?= $u['address'];?></td>
          <td><?= $u['email'];?></td>
          <td><?= $u['date_registered'];?></td>
        </tr>
        <?php endforeach ?>
      </tbody>
	</table>
</div>
	