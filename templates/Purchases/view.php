<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchase $purchase
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Purchase'), ['action' => 'edit', $purchase->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Purchase'), ['action' => 'delete', $purchase->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchase->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Purchases'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Purchase'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="purchases view content">
            <h3><?= h($purchase->transaction_code) ?></h3>
            <table>
                <tr>
                    <th><?= __('Transaction Code') ?></th>
                    <td><?= h($purchase->transaction_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $purchase->has('customer') ? $this->Html->link($purchase->customer->name, ['controller' => 'Customers', 'action' => 'view', $purchase->customer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Motorcycle') ?></th>
                    <td><?= $purchase->has('motorcycle') ? $this->Html->link($purchase->motorcycle->brand, ['controller' => 'Motorcycles', 'action' => 'view', $purchase->motorcycle->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($purchase->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($purchase->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($purchase->date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
