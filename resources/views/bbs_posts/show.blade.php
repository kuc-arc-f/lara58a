@extends('layouts.app')

@section('title', 'show')

@section('content')
<div class="panel panel-default" style="padding-top: 10px;">
	{{ link_to_route('bbs.index', '戻る', null, 
		['class' => 'btn btn-outline-primary btn-sm'] ) }}
	<hr class="mt-2 mb-2" />
	<div class="panel-heading">		  
		<h3 >{{ $bbs_post->title }} </h3>
		<p>
			Date :  {{ $bbs_post->created_at }} <br />
			ID : {{ $bbs_post->id }} <br />
			from : {{ $user->name }} <br />
		</p>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<div class="col-sm-8">
				<pre class="pre_text">{{ $bbs_post->content }}</pre>
			</div>
		</div>
		<hr />
		<h3 style="color: green; ">このスレッドへ返信する :</h3>
		<!--  返信を追加: -->
		{!! Form::model($bbs_post, [
			'route' => 'bbs_answers.store', 'method' => 'post', 'class' => 'form-horizontal'
		]) !!}		
		<div class="form-group">
			{!! Form::hidden('bbs_post_id', $bbs_post->id, [
				 'required'=>'required' ]) 
			!!}                       
			<div class="col-sm-8">
				{!! Form::textarea('content', "" , [
					'id' => 'bbs_answer-content', 'class' => 'form-control',
					'rows' => 8,'cols' => 12, 'required'=>'required'
				]) !!}                        
			</div>
		</div>
		<div class="col-sm-offset-3 col-sm-6">
			{!! Form::button('<i class="fa fa-save"></i> Save', 
			['type' => 'submit', 'class' => 'btn btn-primary']) !!}
		</div>		
		{!! Form::close() !!}
	</div>
	<div class="panel-footer">
		<hr />
		<h3 style="color: green; ">返信の一覧 :</h3>
		<?php // var_dump(count($bbs_answers)); ?>
		<?php $n = count($bbs_answers); 
		if($n < 1){ ?>
			<p style="color : red;"> nothing, Replay post </p>
		<?php } ?>
		<table class="table table-striped bbs-table">
		<tbody>
			@foreach ($bbs_answers as $answer )
			<tr>
				<td class="table-text">
					<pre class="pre_text"><?= $answer->content ?>
					</pre>
					<p>
						<?= $answer->created_at ?> ,ID: <?= $answer->id ?> , 
						<?= $answer->user_name ?>
						<?php if($user_id == $answer->user_id ){ ?>
							<?php  // var_dump( $answer->user_id ); ?>
							<!-- btn btn-outline-danger -->
							{{ Form::open(['route' => ['bbs_answers.destroy', $answer->id], 'method' => 'delete']) }}
							{{ Form::hidden('id', $answer->id) }}
							{!! Form::button('<i class="far fa-trash-alt"></i>', 
							['type' => 'submit', 'class' => 'btn btn-outline-danger']) !!}							
							{{ Form::close() }}							
						<?php }?>
					</p>
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
</div>
<!-- -->
<style>
.panel-body .pre_text{
	border: 1px solid #000;
	background: #EEE;
	padding : 10px;
	font-family: BlinkMacSystemFont,"Segoe UI",Roboto;
	font-size: 1.0rem;	
}    
.panel-footer .pre_text{
	font-family: BlinkMacSystemFont,"Segoe UI",Roboto;
	font-size: 1.0rem;	
}    
</style>
@endsection
