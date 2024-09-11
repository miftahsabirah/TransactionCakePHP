<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Motorcycle $motorcycle
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Motorcycle'), ['action' => 'edit', $motorcycle->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Motorcycle'), ['action' => 'delete', $motorcycle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $motorcycle->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Motorcycles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Motorcycle'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="motorcycles view content">
            <h3><?= h($motorcycle->brand) ?></h3>
            <table>
                <tr>
                    <th><?= __('Brand') ?></th>
                    <td><?= h($motorcycle->brand) ?></td>
                </tr>
                <tr>
                    <th><?= __('Model') ?></th>
                    <td><?= h($motorcycle->model) ?></td>
                </tr>
                <tr>
                    <th><?= __('Year') ?></th>
                    <td><?= h($motorcycle->year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($motorcycle->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Purchases') ?></h4>
                <?php if (!empty($motorcycle->purchases)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Transaction Code') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('Motorcycle Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($motorcycle->purchases as $purchases) : ?>
                        <tr>
                            <td><?= h($purchases->id) ?></td>
                            <td><?= h($purchases->transaction_code) ?></td>
                            <td><?= h($purchases->date) ?></td>
                            <td><?= h($purchases->customer_id) ?></td>
                            <td><?= h($purchases->motorcycle_id) ?></td>
                            <td><?= h($purchases->quantity) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Purchases', 'action' => 'view', $purchases->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Purchases', 'action' => 'edit', $purchases->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Purchases', 'action' => 'delete', $purchases->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchases->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Sales') ?></h4>
                <?php if (!empty($motorcycle->sales)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Transaction Code') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('Motorcycle Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($motorcycle->sales as $sales) : ?>
                        <tr>
                            <td><?= h($sales->id) ?></td>
                            <td><?= h($sales->transaction_code) ?></td>
                            <td><?= h($sales->date) ?></td>
                            <td><?= h($sales->customer_id) ?></td>
                            <td><?= h($sales->motorcycle_id) ?></td>
                            <td><?= h($sales->quantity) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Sales', 'action' => 'view', $sales->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Sales', 'action' => 'edit', $sales->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sales', 'action' => 'delete', $sales->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sales->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
