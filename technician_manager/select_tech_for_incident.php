<?php include '../view/header.php'; ?>
<main>

    <h1>Select Technician</h1>
    <?php var_dump($_SESSION); ?>
    <!-- display a table of technicians -->
    <table>
        <tr>
            <th>Name</th>
            <th>Open Incidents</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($rows as $row) : ?>
            <tr>
                <td><?php echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']); ?></td>
                <td><?php echo htmlspecialchars($row['openInvoices']); ?></td>
                <td>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="assign_incident">
                        <input type="hidden" name="technician_id"
                               value="<?php echo htmlspecialchars($row['techID']); ?>">
                        <input type="submit" value="Select">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</main>
<?php include '../view/footer.php'; ?>
