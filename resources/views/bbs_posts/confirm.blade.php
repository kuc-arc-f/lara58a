@extends('layouts.app')

@section('title', 'confirm')

@section('content')
<div class="panel panel-default" style="padding-top: 10px;">
	{{ link_to_route('bbs.index', '戻る', null, 
		['class' => 'btn btn-outline-primary btn-sm'] ) }}
	<hr class="mt-2 mb-2" />
	<div class="panel-heading">		  
	</div>
	<div class="panel-body">
		{!! Form::label('title', 'タイトル:', ['class' => 'col-sm-3 control-label']) !!}
		<div class="form-group">
			<div class="col-sm-8">
				<h3 >{{ $bbs_post->title }} </h3>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('content', '内容:', ['class' => 'col-sm-3 control-label']) !!}
			<div class="col-sm-8">
				<pre class="pre_text">{{ $bbs_post->content }}</pre>
			</div>
		</div>
		<hr />
		<p style="color: green;">上記の内容で登録します。</p>
		{!! Form::model($bbs_post, [
			'route' => 'bbs.store', 'method' => 'post', 'class' => 'form-horizontal'
		]) !!}
		<div style="display : none;">
			{!! Form::label('title', 'Title:', ['class' => 'col-sm-3 control-label']) !!}
			<div class="col-sm-8">
				{!! Form::text('title', $bbs_post->title, [
					'required'=>'required' ]) 
				!!}
			</div>
			{!! Form::label('content', 'Content:', ['class' => 'col-sm-3 control-label']) !!}
			<div class="col-sm-8">
				{!! Form::textarea('content', $bbs_post->content, [
					'id' => 'todo-content', 'class' => 'form-control',
					'rows' => 10,'cols' => 12
				]) !!}                        
			</div>			
		</div>
		<!-- -->
		<div class="row">
			<div class="col-sm-6 send_btn_wrap">
				{!! Form::button('<i class="fa fa-save"></i> Save', 
				['type' => 'submit', 'class' => 'btn btn-primary']) !!}					
			</div>
			<div class="col-sm-6 send_btn_wrap">
				<a href="#" class="btn btn-outline-primary"
				 onClick="history.back();">修正する</a>					
			</div>
		</div>
		{!! Form::close() !!}	
		<hr />	

	</div>
	<div class="panel-footer">
	</div>
</div>
<!-- -->
<style>
.send_btn_wrap{
	text-align: center;
}
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
