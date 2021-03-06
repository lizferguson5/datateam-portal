<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Notes'), ['controller'=>'notes', 'action' => 'index']) ?></li>
  <li><?= $this->html->link('Note #' . $note->id,['action'=>'view',$note->id]) ?></li>
  <li class="active">Edit</li>
</ol>

<?php 
  $deployments =[];
  foreach ($note->deployments as $d) {
    $deployments[$d['deployment_number']] = [
      'asset_uid'  => $d['sensor_uid'],
      'start_date' => ($d['start_date'] ? $this->Time->format($d['start_date'], 'MM/dd/yyyy') : ''),
      'end_date'   => ($d['stop_date'] ? $this->Time->format($d['stop_date'], 'MM/dd/yyyy') : ''),
    ];
  }    
?>

<?= $this->Form->create($note) ?>
<fieldset>
  <legend>Edit Note</legend>

  <div class="row">
    <div class='col-md-6'>
      <dl class="dl-horizontal">
        <dt><?= __('Reference Designator') ?></dt>
        <dd><?= h($note->reference_designator) ?></dd>
      </dl>
      
      <?php
      echo $this->Form->input('type',['label'=>'Note Type',
        'options'=>[
          'note'=>'Operational Note',
          'issue'=>'Open Issue',
          'resolved'=>'Resolved Issue',
        ],'empty'=>true]);
      echo $this->Form->input('deployment',[
        'empty'=>true,
        'type'=>'select' ] );
      echo $this->Form->input('asset_uid',['label'=>[
        'text'=>'Asset ID <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Enter just the Asset UID. This will automatically update based on the selected deployment."></span>', 
        'escape'=>false] ] );
      echo $this->Form->input('start_date',[
        'type'=>'text',
        'append' => '<span class="glyphicon glyphicon-th" id="start-date-dp"></span>',
        'value'=> $this->Time->i18nFormat($note->start_date,'M/d/yyyy'),
        ]);
      echo $this->Form->input('end_date',[
        'type'=>'text',
        'append' => '<span class="glyphicon glyphicon-th" id="end-date-dp"></span>',
        'value'=> $this->Time->i18nFormat($note->end_date,'M/d/yyyy'),
        ]);
      echo $this->Form->input('user_id', ['options' => $users, 'empty' => true, 'label'=>'Assignee']);
      ?>
    </div>
    <div class='col-md-6'>
      <?php
      echo $this->Form->input('comment',['type'=>'textarea', 'rows'=>12]);
      echo $this->Form->input('redmine_issue',['label'=>[
        'text'=>'Redmine Issue <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Enter just the Redmine issue number."></span>', 
        'escape'=>false] ]);
      echo $this->Form->input('resolved_date',[
        'type'=>'text',
        'append' => '<span class="glyphicon glyphicon-th" id="resolved-date-dp"></span>',
        'value'=> $this->Time->i18nFormat($note->resolved_date,'M/d/yyyy'),
        'empty' => true
        ]);
      echo $this->Form->input('status',['label'=>'Status',
        'options'=>[
          'Available'=>'Available',
          'Not Operational'=>'Not Operational',
          'Not Available'=>'Not Available',
          'Pending Ingest'=>'Pending Ingest',
          'Not Evaluated'=>'Not Evaluated',
          'Suspect'=>'Suspect',
          'Failed'=>'Failed',
          'Pass'=>'Pass',
        ],'empty'=>true]);
      ?>

      <div class="pull-right">
      <?= $this->Html->link('Cancel', ['controller'=>$note->model, 'action' => 'view', $note->reference_designator, '#'=>'notes'], ['class'=>'btn btn-default']); ?> 
      <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?> 
      </div>
      
    </div>
  </div>
</fieldset>
    
<?= $this->Form->end() ?>

<?= $this->Form->postLink(__('Delete Note'), ['action' => 'delete', $note->id], ['confirm' => __('Are you sure you want to delete the note for {0}?', $note->reference_designator), 'class'=>'btn btn-danger']) ?>

<?php $this->Html->css('datepicker/bootstrap-datepicker3',['block'=>true]); ?>
<?php $this->Html->script('datepicker/bootstrap-datepicker',['block'=>true]); ?>

<?php $this->Html->scriptStart(['block' => true]); ?>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  $('#start-date').datepicker({
    autoclose: true,
    todayHighlight: true,
    showOnFocus: false,
    format:  "m/d/yyyy"
  });
  $('#start-date-dp')
    .css('cursor', 'pointer')
    .on('click', function () {
      $('#start-date').datepicker('show');
    });
  $('#end-date').datepicker({
    autoclose: true,
    todayHighlight: true,
    showOnFocus: false,
    format:  "m/d/yyyy"
  });
  $('#end-date-dp')
    .css('cursor', 'pointer')
    .on('click', function () {
      $('#end-date').datepicker('show');
    });
  $('#resolved-date').datepicker({
    autoclose: true,
    todayHighlight: true,
    showOnFocus: false,
    format:  "m/d/yyyy"
  });
  $('#resolved-date-dp')
    .css('cursor', 'pointer')
    .on('click', function () {
      $('#resolved-date').datepicker('show');
    });

  var deployments = <?= json_encode($deployments)?>;
  var mySelect = $('#deployment');
  $.each(deployments, function(i, item) {
    mySelect.append(
        $('<option></option>').val(i).html(i + ': ' + item.start_date + ' to ' + item.end_date)
    );
  });
  mySelect.val(<?=$note['deployment']?>)
  mySelect.on('change', function () {
    asset = (this.value) ? deployments[this.value].asset_uid : '';
    $('#asset-uid').val(asset);
  })

<?php $this->Html->scriptEnd(); ?>