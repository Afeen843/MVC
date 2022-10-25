<?php
include_once('config.php');
include_once('classes/customers.php');
?>
<div class="section">
    <a href="index.php?page=customers&action=addCustomers"><input type="button" value="Add Customers"></a>
    <table>
        <thead>
        <tr>
            <th><?php echo customerInterface::CUSTOMER_ID ?></th>
            <th><?php echo customerInterface::CUSTOMER_NAME ?></th>
            <th><?php echo customerInterface::CUSTOMER_EMAIL ?></th>
            <th><?php echo customerInterface::CUSTOMER_STATE ?></th>
            <th><?php echo customerInterface::CUSTOMERS_ZIPCODE ?></th>
            <th><?php echo customerInterface::CUSTOMER_CITY ?></th>
            <th><?php echo customerInterface::CUSTOMERS_COUNTRY ?></th>
            <th><?php echo customerInterface::CUSTOMER_MOBILE ?></th>
            <th><?php echo customerInterface::CUSTOMER_STATUS ?></th>
            <th> Action</th>

        </tr>
        </thead>

        <?php
        $customer = new customers('pdo', 'localhost', 'root', '');
        $customer->createConnection();
        $row = $customer->showUser();
        foreach ($row

        as $rows){ ?>
        <tbody>
        <tr>
            <td><?php echo $rows[customerInterface::CUSTOMER_ID] ?></td>
            <td><?php echo $rows[customerInterface::CUSTOMER_NAME] ?></td>
            <td><?php echo $rows[customerInterface::CUSTOMER_EMAIL] ?></td>
            <td><?php echo $rows[customerInterface::CUSTOMER_STATE] ?></td>
            <td><?php echo $rows[customerInterface::CUSTOMERS_ZIPCODE] ?></td>
            <td><?php echo $rows[customerInterface::CUSTOMER_CITY] ?></td>
            <td><?php echo $rows[customerInterface::CUSTOMERS_COUNTRY] ?></td>
            <td><?php echo $rows[customerInterface::CUSTOMER_MOBILE] ?></td>
            <td><?php if ($rows[customerInterface::CUSTOMER_STATUS] == '1') echo 'Active'; else 'Deactived'; ?></td>
            <td>
                <a href="index.php?page=customers&action=viewUser&id=<?php echo $rows['entity_id']; ?>">&#9738;</a>
                <a href="index.php?page=customers&action=editUser&id=<?php echo $rows['entity_id']; ?>">&#9986;</a>
                <a href="model/deleteCustomers.php?page=customers&action=delete&id=<?php echo $rows['entity_id']; ?>">&#9747;</a>
            </td>


        </tr>
        <?php } ?>
        </tbody>

    </table>
</div>







