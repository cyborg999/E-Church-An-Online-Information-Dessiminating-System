<?php 
	include_once "backend/process.php";
	$info = $model->getUserById($_GET['id']);
	$info = $info[0];
	// echo "<pre>";
	// print_r($info);
	// die();
?>
<link href="css/bootstrap.min.css" rel="stylesheet">

<div class="container">
	<table data-form="information sheet" >
		<thead>
			<tr>
				<th colspan="4" style="text-align:center;">
					<img width="50" src="img/logo.png">
					<h1>(MARELCO)</h1>
					<p>Boac, Marinduque</p>
					<p>Application For Membership and Information Sheet</p>
					<br>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td> </td>
				<td style="text-align:right;">Date Applied:<span style="text-decoration:underline;"> <?= date("Y-m-d", strtotime($info['date_registered']));?></span></td>
			</tr>
			<tr>
				<td>
					<label>LAST NAME:</label>
				</td>
				<td>
					<p><?= $info['lastname'];?></p>
				</td>
				<td rowspan="4" width="250">
					<br>
					<div class="id"  style="float:right;border:1px dashed black;height:190px;width:200px;">
						<p style="text-align:center;margin-top:45%;">2x2 ID Picture</p>
					</div>
				</td>
				<td rowspan="4" width="250">
					<br>
					<div class="id"  style="float:right;border:1px dashed black;height:190px;width:200px;">
						<p style="text-align:center;margin-top:45%;">2x2 ID Picture</p>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<label>FIRST NAME:</label>
				</td>
				<td>
					<p><?= $info['firstname'];?></p>
				</td>
			</tr>
			<tr>
				<td>
					<label>MIDDLE NAME:</label>
				</td>
				<td>
					<p><?= $info['middlename'];?></p>
				</td>
			</tr>
			<tr>
				<td>
					<label>ADDRESS:</label>
				</td>
				<td>
					<p><?= $info['address'];?></p>
				</td>
			</tr>
			<tr>
				<td>
					<label>NATIONALITY:</label>
				</td>
				<td>
					<p><?= $info['nationality'];?></p>
				</td>
				<td rowspan="3">
					<br>
					<div class="id"  style="float:right;border:1px dashed black;height:190px;width:200px;">
						<p style="text-align:center;margin-top:45%;">thumbmark</p>
					</div>
				</td>
				<td rowspan="3">
					<br>
					<div class="id"  style="float:right;border:1px dashed black;height:190px;width:200px;">
						<p style="text-align:center;margin-top:45%;">thumbmark</p>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<label>CIVIL STATUS:</label>
				</td>
				<td>
					<p><?= $info['civil_status'];?></p>
				</td>
			</tr>
			<tr>
				<td>
					<label>DATE OF BIRTH:</label>
				</td>
				<td>
					<p><?= $info['dob'];?></p>
				</td>
			</tr>
			<tr>
				<td>
					<label>PLACE OF BIRTH:</label>
				</td>
				<td>
					<p><?= $info['pob'];?></p>
				</td>
			</tr>
			<tr>
				<td>
					<label>AGE:</label>
				</td>
				<td >
					<p><?= $info['age'];?></p>
				</td>
			
			</tr>
	<!-- 		<tr>
				<td>
					<label>OCCUPATION</label>
				</td>
				<td>
					<p></p>
				</td>
			</tr> -->
			<tr>
				<td>
					<br>
					<label>SPOUSE:</label>
					<br>
				</td>
				<td>
					<!-- <input type="text"> -->
				</td>
			</tr>
			<tr>
				<td>
					<label>LAST NAME:</label>
				</td>
				<td>
					<p><?= $info['sLastname'];?></p>
				</td>
				<td rowspan="9" colspan="2" >
					<table  width="100%;">
						<tr>
							<td>
								<label style="text-align:center; width:100%;display:block;">Children</label>
							</td>
							<td>
								<label style="text-align:center; width:100%;display:block;">Date of Birth</label>
							</td>
						</tr>
						<?php $children = $model->getChildrenById($_GET['id']); ?>
						<?php foreach($children as $idx => $c): ?>
							<tr>
								<td>
									<p style="text-align:center;"><?= $c['name'];?></p>
								</td>
								<td>
									<p style="text-align:center;"><?= $c['dob'];?></p>
								</td>
							</tr>
						<?php endforeach ?>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<label>FIRST NAME:</label>
				</td>
				<td>
					<p><?= $info['sFirstname'];?></p>
				</td>
				
			</tr>
			<tr>
				<td>
					<label>MIDDLE NAME:</label>
				</td>
				<td>
					<p><?= $info['sMiddlename'];?></p>
				</td>
				
			</tr>
			<tr>
				<td>
					<label>DATE OF BIRTH:</label>
				</td>
				<td>
					<p><?= $info['sDob'];?></p>
				</td>
				
			</tr>
			<tr>
				<td>
					<label>PLACE OF BIRTH:</label>
				</td>
				<td>
					<p><?= $info['sPob'];?></p>
				</td>
				
			</tr>
			
			<tr>
				<td>
					<label>OCCUPATION:</label>
				</td>
				<td>
					<p><?= $info['sOccupation'];?></p>
				</td>
			</tr>
		</tbody>
	</table>

</div>
	