<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchase $purchase
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 * @var \Cake\Collection\CollectionInterface|string[] $motorcycles
 */

use function PHPSTORM_META\type;

?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Purchases'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="purchases form content">
            <?= $this->Form->create($purchase) ?>
            <fieldset>
                <legend><?= __('Add Purchase') ?></legend>
                <?php
                    echo $this->Form->control('transaction_code', ['type' => 'hidden']);
                    echo $this->Form->control('date');
                    echo $this->Form->control('customer_id', ['options' => $customers]);
                    echo $this->Form->control('motorcycle_id', ['options' => $motorcycles]);
                    echo $this->Form->control('quantity');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
