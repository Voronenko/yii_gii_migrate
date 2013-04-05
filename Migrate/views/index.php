<h1>Migration generator</h1>

<?php $form = $this->beginWidget('CCodeForm', array('model' => $model)); ?>
<?php echo $form->hiddenField($model, '_migrateName'); ?>

<div class="row">
    <?php echo $form->labelEx($model, 'migrateName'); ?>
    <?php echo $form->textField($model, 'migrateName', array('size' => 65)); ?>
    <div class="tooltip">
        Migration should be only latter
    </div>
    <?php echo $form->error($model, 'migrateName'); ?>
</div>


<div class="row">
    <?php echo $form->labelEx($model, 'alreadyAppliedCode'); ?>
    <?php echo $form->textArea($model, 'alreadyAppliedCode', array('rows' => 6, 'cols' => 50)); ?>
    <div class="tooltip">
        SQL criteria to check if migration applied (:CURRENTDB is current DB name)
        <br/>
        <br/>
        <br/>
        <i>
            SELECT *
            FROM information_schema.COLUMNS
            WHERE TABLE_SCHEMA = :CURRENTDB
            AND TABLE_NAME = 'TABLE_YOU_AMEND'
            AND COLUMN_NAME = 'FIELD_YOU_ADD'
        </i>
    </div>
    <?php echo $form->error($model, 'alreadyAppliedCode'); ?>
</div>


<div class="row">
    <?php echo $form->labelEx($model, 'code'); ?>
    <?php echo $form->textArea($model, 'code', array('rows' => 6, 'cols' => 50)); ?>
    <div class="tooltip">
        SQL code
    </div>
    <?php echo $form->error($model, 'code'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'clearCache'); ?>
    <?php echo $form->checkBox($model, 'clearCache'); ?>
    <div class="tooltip">
        Is cache need to flush
    </div>
    <?php echo $form->error($model, 'clearCache'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'clearAssets'); ?>
    <?php echo $form->checkBox($model, 'clearAssets'); ?>
    <div class="tooltip">
        Is assets need to clear
    </div>
    <?php echo $form->error($model, 'clearAssets'); ?>
</div>

<?php $this->endWidget(); ?>
