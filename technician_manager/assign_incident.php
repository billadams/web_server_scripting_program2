<?php include '../view/header.php'; ?>
    <main>

        <h1>Assign Incident</h1>
        <?php
            var_dump($_SESSION['technician_id']);
            var_dump($_SESSION['incident_id']);
        ?>
        <!-- display a table of technicians -->
        <p>Customer: </p>
        <p>Product: </p>
        <p>Technician: </p>

        <form action="assign_incident.php" method="post">
            <input type="hidden" name="action" value="assign_incident">
            <input type="hidden" name="technician_id"
                   value="<?php echo htmlspecialchars($row['techID']); ?>">
            <input type="submit" value="Assign Incident">
        </form>

    </main>
<?php include '../view/footer.php'; ?>