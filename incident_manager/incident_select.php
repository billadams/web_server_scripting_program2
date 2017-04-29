<?php include '../view/header.php'; ?>
<main>

    <h2>Select Incident</h2>

    <table>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Date Opened</th>
            <th>Title</th>
            <th>Description</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($incidents as $incident) :
            $ts = strtotime($incident[ 'dateOpened' ]);
            $date_opened_formatted = date('n/j/Y', $ts);
            ?>
            <tr>
                <td><?php echo htmlspecialchars($incident[ 'firstName' ] . ' ' . $incident[ 'lastName' ]); ?></td>
                <td><?php echo htmlspecialchars($incident[ '' ]); ?></td>
                <td><?php echo htmlspecialchars($incident[ 'version' ]); ?></td>
                <td><?php echo $release_date_formatted; ?></td>
                <td>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_product">
                        <input type="hidden" name="product_code"
                               value="<?php echo htmlspecialchars($product[ 'productCode' ]); ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <p><a href="?action=display_customer_get">Make an Incident</a></p>
</main>
<?php include '../view/footer.php'; ?>