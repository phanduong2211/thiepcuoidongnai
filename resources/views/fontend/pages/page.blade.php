@extends('fontend.index')
@section('main')
<section style="clear: both;" class="main-content-section">
	<div style="margin-left:10px" class="container">
		<?php echo $pages[0]->content; ?>
	</div>
</section>
@stop