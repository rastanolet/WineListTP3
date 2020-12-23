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
echo $this->Html->script([
    'https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.js'
        ], ['block' => 'scriptLibraries']
);
$urlToLinkedListFilter = $this->Url->build([
    "controller" => "Countries",
    "action" => "getCountries",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToLinkedListFilter = "' . $urlToLinkedListFilter . '";', ['block' => true]);
echo $this->Html->script('Wines/add_edit/add_edit', ['block' => 'scriptBottom']);
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
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
<div class="wines form large-9 medium-8 columns content" ng-app="linkedlists" ng-controller="countriesController">
    <?= $this->Form->create($wine) ?>
    <fieldset>
        <legend><?= __('Add Wine') ?></legend>
        <?php
            echo $this->Form->control('color_id', ['options' => $colors]);
            echo $this->Form->control('grapes._ids', ['options' => $grapes]);
            ?>
        <div>
            <?= __('Countries') ?> : 
            <select 
                name="country_id"
                id="country-id" 
                ng-model="country" 
                ng-options="country.name for country in countries track by country.id"
                >
                <option value=''>Select</option>
            </select>
        </div>
        <div>
            <?= __('Regions') ?> : 
            <!-- pre ng-show='countries'>{{ countries | json }}></pre-->
            <select
                name="region_id"
                id="region-id" 
                ng-disabled="!country" 
                ng-model="region"
                ng-options="region.name for region in country.regions track by region.id"
                >
                <option value=''>Select</option>
            </select>
        </div>
        
        <?php
            echo $this->Form->control('vineyard_id', ['label' => 'vineyard_id', 'type' => 'hidden']);
            ?>
            
        <div class="input text">
            <label for="autocomplete"><?= __("Vineyard"). ' (' . __('Autocompletete') . ')' ?></label>
            <input id="autocomplete" type="text">
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
