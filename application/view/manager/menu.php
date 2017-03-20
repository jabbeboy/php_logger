<!-- Manager Menu -->
<div class="container">
    <a href="<?php echo URL . 'manager' ?>"><i>Go back</i></a>
    <h2>Menu</h2>
    <p>Sessions and IP-Addresses are ordered in a descending order with the latest at the top</p>

    <!-- Show All Logs  -->
    <div class="box">
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>View</td>
                <td>Select by all</td>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="<?php echo URL . 'manager/logs/' ?>">View</a></td>
                    <td>All Logs</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Select Session -->
    <div class="box" style="overflow-x:auto">
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>View</td>
                <td>Select by session</td>
            </tr>
            </thead>
            <tbody>
			<?php foreach ($sessions as $log) { ?>
                <tr>
                    <td><a href="<?php if (isset($log->session_id)) echo URL . 'manager/session/' . $log->session_id; ?>">View</a></td>
                    <td><?php if (isset($log->session_id)) echo $log->session_id ?></td>
                </tr>
			<?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Select Address -->
    <div class="box" style="overflow-x:auto">
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>View</td>
                <td>Select by ip-address</td>
            </tr>
            </thead>
            <tbody>
			<?php foreach ($addresses as $log) { ?>
                <tr>
                    <td><a href="<?php if (isset($log->address)) echo URL . 'manager/address/' . $log->address; ?>">View</a></td>
                    <td><?php if (isset($log->address)) echo $log->address; ?></td>
                </tr>
			<?php } ?>
            </tbody>
        </table>
    </div>
</div>
