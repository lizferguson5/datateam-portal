<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Assets'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($asset->ooi_barcode) ?></li>
</ol>

<h3>OOI Barcode: <?= h($asset->ooi_barcode) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Manufacturer') ?></dt>
  <dd><?= h($asset->manufacturer) ?></dd>
  <dt><?= __('Model') ?></dt>
  <dd><?= h($asset->model) ?></dd>
  <dt><?= __('Manufacturer Serial No') ?></dt>
  <dd><?= h($asset->manufacturer_serial_no) ?></dd>
  <dt><?= __('Firmware Version') ?></dt>
  <dd><?= h($asset->firmware_version) ?></dd>
  <dt><?= __('Source Of The Equipment') ?></dt>
  <dd><?= h($asset->source_of_the_equipment) ?></dd>
  <dt><?= __('Whether Title') ?></dt>
  <dd><?= h($asset->whether_title) ?></dd>
  <dt><?= __('Location') ?></dt>
  <dd><?= h($asset->location) ?></dd>
  <dt><?= __('Room Number') ?></dt>
  <dd><?= h($asset->room_number) ?></dd>
  <dt><?= __('Condition') ?></dt>
  <dd><?= h($asset->condition) ?></dd>
  <dt><?= __('Acquisition Date') ?></dt>
  <dd><?= h($asset->acquisition_date) ?></dd>
  <dt><?= __('Original Cost') ?></dt>
  <dd><?= h($asset->original_cost) ?></dd>
  <dt><?= __('Federal Participation') ?></dt>
  <dd><?= h($asset->federal_participation) ?></dd>
  <dt><?= __('Primary Tag Date') ?></dt>
  <dd><?= h($asset->primary_tag_date) ?></dd>
  <dt><?= __('Primary Tag Organization') ?></dt>
  <dd><?= h($asset->primary_tag_organization) ?></dd>
  <dt><?= __('Primary Institute Asset Tag') ?></dt>
  <dd><?= h($asset->primary_institute_asset_tag) ?></dd>
  <dt><?= __('Secondary Tag Date') ?></dt>
  <dd><?= h($asset->secondary_tag_date) ?></dd>
  <dt><?= __('Second Tag Organization') ?></dt>
  <dd><?= h($asset->second_tag_organization) ?></dd>
  <dt><?= __('Institute Asset Tag') ?></dt>
  <dd><?= h($asset->institute_asset_tag) ?></dd>
  <dt><?= __('Doi Tag Date') ?></dt>
  <dd><?= h($asset->doi_tag_date) ?></dd>
  <dt><?= __('Doi Tag Organization') ?></dt>
  <dd><?= h($asset->doi_tag_organization) ?></dd>
  <dt><?= __('Doi Institute Asset Tag') ?></dt>
  <dd><?= h($asset->doi_institute_asset_tag) ?></dd>
  <dt><?= __('Id') ?></dt>
  <dd><?= $this->Number->format($asset->id) ?></dd>
  <dt><?= __('Quant') ?></dt>
  <dd><?= $this->Number->format($asset->quant) ?></dd>
  <dt><?= __('Description Of Equipment') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($asset->description_of_equipment)); ?></dd>
  <dt><?= __('Comments') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($asset->comments)); ?></dd>
</dl>
