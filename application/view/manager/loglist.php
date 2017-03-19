<div class="container">
    <a href="<?php echo URL . 'manager' ?>"><i>Go back</i></a>
    <h2>Menu</h2>
    <p>Sessions and IP-Addresses are ordered in a descending order with the latest at the top</p>

    <!-- Show all log information and all logs in one table -->
    <div class="box">
        <h3>Select by All Logs</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>All</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><a href="<?php echo URL . 'manager/logs/' ?>">View</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Select session table -->
    <div class="box" style="overflow-x:auto">
        <h3>Select by Session</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>View</td>
                <td>Session</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($sessions as $log) { ?>
                <tr>
                    <td><a href="<?php if (isset($log->session_id)); echo URL . 'manager/sessions/' . $log->session_id ?>">View</a></td>
                    <td><?php if (isset($log->session_id)) echo $log->session_id ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Select address table -->
    <div class="box" style="overflow-x:auto">
        <h3>Select by IP Address</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>View</td>
                <td>IP-Address</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($addresses as $log) { ?>
                <tr>
                    <td><a href="<?php if (isset($log->address)) echo URL . 'manager/addresses/' . $log->address; ?>">View</a></td>
                    <td><?php if (isset($log->address)) echo $log->address; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
