<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grape $grape
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Grape'), ['action' => 'edit', $grape->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Grape'), ['action' => 'delete', $grape->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grape->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Grapes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grape'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Wines'), ['controller' => 'Wines', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wine'), ['controller' => 'Wines', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="grapes view large-9 medium-8 columns content">
    <h3><?= h($grape->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($grape->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($grape->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Wines') ?></h4>
        <?php if (!empty($grape->wines)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Color Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Region Id') ?></th>
                <th scope="col"><?= __('Vineyard Id') ?></th>
                <th scope="col"><?= __('Year Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Photo') ?></th>
                <th scope="col"><?= __('Rating AVG') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($grape->wines as $wines): ?>
            <tr>
                <td><?= h($wines->id) ?></td>
                <td><?= h($wines->user_id) ?></td>
                <td><?= h($wines->color_id) ?></td>
                <td><?= h($wines->country_id) ?></td>
                <td><?= h($wines->region_id) ?></td>
                <td><?= h($wines->vineyard_id) ?></td>
                <td><?= h($wines->year_id) ?></td>
                <td><?= h($wines->name) ?></td>
                <td><?= h($wines->price) ?></td>
                <td><?= h($wines->description) ?></td>
                <td><?= h($wines->photo) ?></td>
                <td><?= h($wines->rating_AVG) ?></td>
                <td><?= h($wines->created) ?></td>
                <td><?= h($wines->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Wines', 'action' => 'view', $wines->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Wines', 'action' => 'edit', $wines->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Wines', 'action' => 'delete', $wines->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wines->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
