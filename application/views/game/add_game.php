<div class="page-header">
	<h1>Dodaj wpis</h1>
</div>
<div class="row">
	<div class="span12">
		<!-- Otwieramy formularz -->
		<?php echo form_open('http://[::1]/cd/games/add', array('class'=>'form-horizontal')); ?>
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="title">Tytuł</label>
				<div class="controls">
					<?php echo form_input(array(
					'type' => 'text',
					'name'=>'title',
					'id'=> 'title',
					'placeholder'=>'Game title',
					'class'=>'input-xlarge',
					'value'=> set_value('title'))); ?>
					<?php echo form_error('title') ?>
				</div>
				
				<label class="control-label" for="describe">Opis</label>
				<div class="controls">
					<?php echo form_textarea(array(
					'type' => 'text',
					'name'=>'describe',
					'id'=> 'describe',
					'rows'=>'8',
					'placeholder'=>'Game describe',
					'class'=>'input-xlarge',
					'value'=> nl2br(set_value('describe')))); ?>
					<?php echo form_error('describe') ?>
				</div>

				<label class="control-label" for="title">Premiera</label>
				<div class="controls">
					<?php echo form_textarea(array(
					'type' => 'text',
					'name'=>'premiere',
					'id'=> 'premiere',
					'placeholder'=>'Game premiere',
					'class'=>'input-xlarge',
					'value'=> set_value('premiere'))); ?>
					<?php echo form_error('premiere') ?>
				</div>
				
				<!-- <div class="controls col-sm-3">
					<div class='input-group date' id='datetimepicker5'>
						<?php echo form_input(array(
							'class'=>'form-control',
							'type' => 'text',
							'name'=>'premiere',
							'id'=> 'premiere')); ?>
							
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
				<?php echo form_error('premiere'); ?>
							</div> -->
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Dodaj wpis</button>
				<a class="btn" href="<?php echo site_url('posts'); ?>">Anuluj</a>
			</div>
		</fieldset>
</div>
		<!-- Zamykamu formularz -->
		<?php echo form_close(); ?>
	</div>
</div>