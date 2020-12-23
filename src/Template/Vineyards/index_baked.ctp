<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vineyard[]|\Cake\Collection\CollectionInterface $vineyards
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vineyard'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Wines'), ['controller' => 'Wines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wine'), ['controller' => 'Wines', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vineyards index large-9 medium-8 columns content">
    <h3><?= __('Vineyards') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vineyards as $vineyard): ?>
            <tr>
                <td><?= $this->Number->format($vineyard->id) ?></td>
                <td><?= h($vineyard->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vineyard->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vineyard->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vineyard->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vineyard->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
