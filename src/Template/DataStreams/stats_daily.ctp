<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li>...</li>
  <li><?= $this->html->link($dataStream->reference_designator,['controller'=>'instruments','action'=>'view',$dataStream->reference_designator]) ?></li>
  <li class="active"><?= h($dataStream->method) ?> / <?= h($dataStream->stream_name) ?></li>
</ol>

<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
<div class="btn-group btn-group-sm " role="group" aria-label="...">
  <?php echo $this->Html->link('OOI Site Page <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 
    'http://oceanobservatories.org/site/' . substr($dataStream->reference_designator,0,8), 
    ['class'=>'btn btn-default', 'escape'=>false]); ?>
  <?php echo $this->Html->link('Data Portal <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 
    'https://ooinet.oceanobservatories.org/plot/#' . $dataStream->reference_designator, 
    ['class'=>'btn btn-default', 'escape'=>false]); ?>
</div>
<div class="btn-group btn-group-sm" role="group" aria-label="...">
  <?php echo $this->Html->link('Report <span class="glyphicon glyphicon-info-sign" aria-hidden="true">', 
    ['controller'=>'data-streams', 'action' => 'view', $dataStream->id],
    ['class'=>'btn btn-default','escape'=>false]) ?>
  <?php echo $this->Html->link('Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
    ['controller'=>'data-streams', 'action' => 'stats-daily', $dataStream->id],
    ['class'=>'btn btn-primary active','escape'=>false]) ?>
  <?php echo $this->Html->link('Plot <span class="glyphicon glyphicon-signal" aria-hidden="true">', 
    ['controller'=>'data-streams', 'action' => 'plot', $dataStream->id],
    ['class'=>'btn btn-default','escape'=>false]) ?>
</div>
</div>

<h3>Data Stream Report</h3>

<div class="row">
  <div class="col-md-5">
    <dl class="dl-horizontal">
      <dt><?= __('Reference Designator') ?></dt>
      <dd><?= $this->Html->link($dataStream->reference_designator, ['controller' => 'instruments', 'action' => 'view', $dataStream->reference_designator]) ?></dd>
      <dt><?= __('Method') ?></dt>
      <dd><?= h($dataStream->method) ?></dd>
      <dt><?= __('Stream') ?></dt>
      <dd><?= $dataStream->stream_name ?></dd>
    </dl>
  </div>
</div>

<!-- Stats Graph -->
<?php echo $this->element('daily_stats', 
  ['data_url'=>$this->Url->build([
    'controller'=>'data-streams',
    'action'=>'statsDaily',
    $dataStream->id,
    '_ext'=>'json'])
  ]);
?>

<?php if(isset($import_time)): ?>
<p>Last import: <?= $this->Time->timeAgoInWords($import_time->import_date) ?>
<?php endif; ?>
