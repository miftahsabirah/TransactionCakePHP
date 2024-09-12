<div class="report-purchases form">
    <?= $this->Form->create(null, ['url' => ['action' => 'index']]) ?>
    <fieldset>
        <legend><?= __('Export Purchases') ?></legend>

        <?= $this->Form->control('start_date', ['type' => 'date', 'label' => 'Tanggal Awal']) ?>
        <?= $this->Form->control('end_date', ['type' => 'date', 'label' => 'Tanggal Akhir']) ?>

        <div class="form-group">
            <label><?= __('Export') ?></label>
            <?= $this->Form->radio('export_type', [
                ['value' => 'html', 'text' => 'HTML'],
                ['value' => 'excel', 'text' => 'Excel']
            ]) ?>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Export')) ?>
    <?= $this->Form->end() ?>
</div>
