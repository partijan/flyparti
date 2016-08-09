<div class="box">
    <table class="table-list">
        <tr>
            <th>E-mail</th>
            
            <th>Datum</th>
            
            <th>Name</th>
             <th> </th>
        </tr>

        <?php foreach ($items as $item) { ?>
            <tr>
                <td><?php echo $item['email']; ?></td>
                <td><?php echo $item['dtCreated']; ?></td>
                <td><?php echo $item['name']; ?></td>
               
                <td>
                    <a href="?id=<?php echo $item['id']; ?>">editovat</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

