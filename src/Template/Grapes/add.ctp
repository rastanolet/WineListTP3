<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grape $grape
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Grapes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Wines'), ['controller' => 'Wines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wine'), ['controller' => 'Wines', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grapes form large-9 medium-8 columns content">
    <?= $this->Form->create($grape) ?>
    <fieldset>
        <legend><?= __('Add Grape') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
