<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Wine $wine
 */
?>

<?php
$urlToVineyardsAutocompletedemoJson = $this->Url->build([
    "controller" => "Vineyards",
    "action" => "findVineyards",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToAutocompleteAction = "' . $urlToVineyardsAutocompletedemoJson . '";', ['block' => true]);
echo $this->Html->script('Wines/add_edit/vineyardAutocomplete', ['block' => 'scriptBottom']);
?>

<?php
$urlToLinkedListFilter = $this->Url->build([
    "controller" => "Regions",
    "action" => "getByCountry",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToLinkedListFilter = "' . $urlToLinkedListFilter . '";', ['block' => true]);
echo $this->Html->script('Wines/add_edit/add_edit', ['block' => 'scriptBottom']);
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $wine->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $wine->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Wines'), ['action' => 'index']) ?></li>
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
<div class="wines form large-9 medium-8 columns content">
    <?= $this->Form->create($wine) ?>
    <fieldset>
        <legend><?= __('Edit Wine') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['type' => 'hidden']);
            echo $this->Form->control('color_id', ['options' => $colors]);
            echo $this->Form->control('grapes._ids', ['options' => $grapes]);
            echo $this->Form->control('files._ids', ['options' => $files]);
            echo $this->Form->control('country_id', ['options' => $countries]);
            echo $this->Form->control('region_id', ['options' => $regions]);
            echo $this->Form->control('vineyard_id', ['label' => '(vineyard_id)', 'type' => 'hidden']);
        ?>
        <div class="input text">
            <label for="autocomplete"><?= __("Vineyard"). ' (' . __('Autocomplete') . ') ' ?></label>
            <input id="autocomplete" type="text" value="<?= $wine->vineyard->name; ?>">
        </div>
        
        <?php
            echo $this->Form->control('year_id', ['options' => $years]);
            echo $this->Form->control('name');
            echo $this->Form->control('price');
            echo $this->Form->control('description');
            echo $this->Form->control('rating_AVG');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
