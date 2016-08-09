<div class="box">
    <table class="table-list">
        <tr>
            <th>Datum vytvoření</th>

            <th>Platnost od</th>

            <th>Platnost do</th>

            <th>Název destinace</th>

            <th>Editovat</th>


        </tr>

        <?php
        foreach ($items as $item)
        {
            ?>
            <tr>
                <td><?php echo formatToDate($item['dtCreated']); ?></td>
                <td><?php echo formatToDate($item['dtValidFrom']); ?></td>
                <td><?php echo formatToDate($item['dtValidTo']); ?></td>
                <td><?php echo $item['title']; ?></td>
                <td>
                    <a href="?id=<?php echo $item['id']; ?>">editovat</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

