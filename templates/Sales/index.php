<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sale> $sales
 */
?>
<div class="sales index content">
    <?= $this->Html->link(__('New Sale'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Sales') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('transaction_code') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('customer_id') ?></th>
                    <th><?= $this->Paginator->sort('motorcycle_id') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('Voucher') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= $this->Number->format($sale->id) ?></td>
                    <td><?= h($sale->transaction_code) ?></td>
                    <td><?= h($sale->date) ?></td>
                    <td><?= $sale->has('customer') ? $this->Html->link($sale->customer->name, ['controller' => 'Customers', 'action' => 'view', $sale->customer->id]) : '' ?></td>
                    <td><?= $sale->has('motorcycle') ? $this->Html->link($sale->motorcycle->brand, ['controller' => 'Motorcycles', 'action' => 'view', $sale->motorcycle->id]) : '' ?></td>
                    <td><?= $this->Number->format($sale->quantity) ?></td>
                    <td>
                        <?= $this->Voucher->getVoucher($sale->quantity) ?>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $sale->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sale->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sale->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
