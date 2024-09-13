<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Purchase> $purchases
 */
?>
<div class="purchases index content">
    <?= $this->Html->link(__('New Purchase'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Purchases') ?></h3>
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
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchases as $purchase): ?>
                <tr>
                    <td><?= $this->Number->format($purchase->id) ?></td>
                    <td><?= h($purchase->transaction_code) ?></td>
                    <td><?= h($purchase->date) ?></td>
                    <td><?= $purchase->has('customer') ? $this->Html->link($purchase->customer->name, ['controller' => 'Customers', 'action' => 'view', $purchase->customer->id]) : '' ?></td>
                    <td><?= $purchase->has('motorcycle') ? $this->Html->link($purchase->motorcycle->brand, ['controller' => 'Motorcycles', 'action' => 'view', $purchase->motorcycle->id]) : '' ?></td>
                    <td><?= $this->Number->format($purchase->quantity) ?></td>
                    <td><?= $purchase->has('creator') ? $this->Html->link($purchase->creator->email, ['controller' => 'Users', 'action' => 'view', $purchase->creator->id]) : '' ?></td>
                    <td><?= $purchase->has('modifier') ? $this->Html->link($purchase->modifier->email, ['controller' => 'Users', 'action' => 'view', $purchase->modifier->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $purchase->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchase->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchase->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchase->id)]) ?>
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

