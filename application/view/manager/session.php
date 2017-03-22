<!-- Session Log --->
<div class="container">
	<a href="<?php echo URL . 'manager/menu'; ?>"><i>Go back</i></a>
	<h2>Logs by Session</h2>
    <p>Here are all the logged events within the same session that has been saved to the database.
        <br>
        They are in a date descending order with the latest log at the top.
    </p>
	<div class="box" style="overflow-x:auto">
		<table>
			<thead style="background-color: #ddd; font-weight: bold;">
			<tr>
				<td>Id</td>
				<td>View</td>
				<td>Date and Time</td>
				<td>Session Id</td>
				<td>IP-Address</td>
				<td>Delete</td>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($logs as $log) { ?>
				<tr>
					<td><?php if (isset($log->id)) echo $log->id; ?></td>
					<td><a href="<?php if (isset($log->session_id)) echo URL . 'manager/viewlog/' . $log->session_id . '=' . $log->id; ?>">View</a></td>
					<td><?php if (isset($log->date_time)) echo $log->date_time; ?></a></td>
					<td><?php if(isset($log->session_id)) echo $log->session_id; ?></td>
					<td><?php if (isset($log->address)) echo $log->address; ?></a></td>
					<td><a href="<?php echo URL . 'manager/deletelog/' . $log->session_id . '='. $log->id; ?>">Delete</a></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
