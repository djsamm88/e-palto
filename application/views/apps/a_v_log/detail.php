<?php
$logID="";
$userName="";
$accessIP="";
$accessTime="";
$accessUrl="";
$accessAction="";
$accessDescription="";

foreach ($sql1->result() as $obj1){	
	$logID = $obj1->logID;
	$userName = $obj1->userName;
	$accessIP = dmy1($obj1->accessIP);
	$accessTime = $obj1->accessTime;
	$accessUrl = $obj1->accessUrl;
	$accessAction = $obj1->accessAction;
	$accessDescription = $obj1->accessDescription;

	$created_by = $obj1->created_by;
	$dt_created = $obj1->dt_created;
	$updated_by = $obj1->updated_by;
	$dt_updated = $obj1->dt_updated;
}
?>

<div class="table-responsive">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th colspan="2">Data log</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="span3">logID</td><td><?php echo $logID; ?></td>
			</tr>
			<tr>
				<td>userName</td><td><?php echo $userName; ?></td>
			</tr>
			<tr>
				<td>accessIP</td><td><?php echo $accessIP; ?></td>
			</tr>
			<tr>
				<td>accessTime</td><td><?php echo $accessTime; ?></td>
			</tr>
			<tr>
				<td>accessUrl</td><td><?php echo $accessUrl; ?></td>
			</tr>
			<tr>
				<td>accessAction</td><td><?php echo $accessAction; ?></td>
			</tr>
			<tr>
				<td>accessDescription</td><td><?php echo $accessDescription; ?></td>
			</tr>
		</tbody>
		<thead>
			<tr>
				<th colspan="2">Data User</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td>Created By</td><td><?php echo $created_by; ?></td>
			</tr>
			<tr>
				<td>Created On</td><td><?php echo $dt_created; ?></td>
			</tr>
			<tr>
				<td>Updated By</td><td><?php echo $updated_by; ?></td>
			</tr>
			<tr>
				<td>Updated On</td><td><?php echo $dt_updated; ?></td>
			</tr>
		</tfoot>
	</table>
</div>