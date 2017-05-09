<?php include '../view/header.php'; ?>
    <main>

        <h1>Assign Incident</h1>

        <?php if ($assigned === false) : ?>
            <p>Customer: <?php echo $customer_name; ?></p>
            <p>Product: <?php echo $product_code; ?></p>
            <p>Technician: <?php echo $technician_name; ?></p>

            <form action="./" method="post">
                <input type="hidden" name="action" value="update_incident">
                <input type="hidden" name="incident_id"
            value="<?php echo htmlspecialchars($_SESSION['incident_id']); ?>">
            <input type="submit" value="Assign Incident">
            </form>
        <?php else : ?>
            <p>This incident was assigned to a technician.</p>
            <p><a href="../incident_manager/">Select another incident</a></p>
        <?php endif; ?>
    </main>
<?php include '../view/footer.php'; ?>