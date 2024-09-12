<div class="purchases-report">
    <h2><?= __('Purchases Report') ?></h2>

    <table>
        <thead>
            <tr>
                <th><?= __('Transaction Code') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Motorcycle Brand') ?></th>
                <th><?= __('Quantity') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchases as $purchase): ?>
            <tr>
                <td><?= h($purchase->transaction_code) ?></td>
                <td><?= h($purchase->date->format('Y-m-d')) ?></td>
                <td><?= h($purchase->customer->name) ?></td>
                <td><?= h($purchase->motorcycle->brand) ?></td>
                <td><?= h($purchase->quantity) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
