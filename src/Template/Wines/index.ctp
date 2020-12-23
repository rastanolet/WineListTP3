<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Wine[]|\Cake\Collection\CollectionInterface $wines
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Wine'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Colors'), ['controller' => 'Colors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Color'), ['controller' => 'Colors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Grapes'), ['controller' => 'Grapes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grape'), ['controller' => 'Grapes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Regions'), ['controller' => 'Regions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Region'), ['controller' => 'Regions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vineyards'), ['controller' => 'Vineyards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vineyard'), ['controller' => 'Vineyards', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Years'), ['controller' => 'Years', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Year'), ['controller' => 'Years', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="wines index large-9 medium-8 columns content">
    <h3><?= __('Wines') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('region_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vineyard_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('year_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rating_AVG') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wines as $wine): ?>
            <tr>
                <td><?= $this->Number->format($wine->id) ?></td>
                <td><?= $wine->has('user') ? $this->Html->link($wine->user->username, ['controller' => 'Users', 'action' => 'view', $wine->user->id]) : '' ?></td>
                <td><?= $wine->has('color') ? $this->Html->link($wine->color->name, ['controller' => 'Colors', 'action' => 'view', $wine->color->id]) : '' ?></td>
                <td><?= $wine->has('country') ? $this->Html->link($wine->country->name, ['controller' => 'Countries', 'action' => 'view', $wine->country->id]) : '' ?></td>
                <td><?= $wine->has('region') ? $this->Html->link($wine->region->name, ['controller' => 'Regions', 'action' => 'view', $wine->region->id]) : '' ?></td>
                <td><?= $wine->has('vineyard') ? $this->Html->link($wine->vineyard->name, ['controller' => 'Vineyards', 'action' => 'view', $wine->vineyard->id]) : '' ?></td>
                <td><?= $wine->has('year') ? $this->Html->link($wine->year->year_number, ['controller' => 'Years', 'action' => 'view', $wine->year->id]) : '' ?></td>
                <td><?= h($wine->name) ?></td>
                <td><?= $this->Number->format($wine->price) ?></td>
				

				
                <td><?= $this->Number->format($wine->rating_AVG) ?></td>
                <td><?= h($wine->created) ?></td>
                <td><?= h($wine->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $wine->id]) ?>
                    <?= $this->Html->link('(pdf)', ['action' => 'view', $wine->id . '.pdf']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $wine->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $wine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wine->id)]) ?>
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
