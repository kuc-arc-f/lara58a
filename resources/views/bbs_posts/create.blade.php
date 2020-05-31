
@extends('layouts.app')

@section('title', '新規作成')

@section('content')
	<div class="panel panel-default">
		<br />
		<div class="panel-heading">
			{{ link_to_route('bbs.index', '戻る', null, ['class' => 'btn btn-outline-primary'] ) }}
			<br />
			<br />
			<!-- class="mt-10" -->
			<h3 >BBS - 新規作成</h3>
		</div>
		<hr />
		@if (count($errors) > 0)
			<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
			</div>
		@endif
		<div class="panel-body">
			{!! Form::model($bbs_post, [
				'route' => 'bbs.confirm', 'method' => 'post', 'class' => 'form-horizontal'
			]) !!}

			<div class="form-group">
				<?php
				$class_title = "form-control";
				?>
				{!! Form::label('title', 'Title:', ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-6">
					{!! Form::text('title', $bbs_post->title, [
						'id' => 'bbs_post-title', 'class' => $class_title ,'required'=>'required' ]) 
					!!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('content', 'Content:', ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-8">
					{!! Form::textarea('content', $bbs_post->content, [
						'id' => 'todo-content', 'class' => 'form-control',
						'rows' => 10,'cols' => 12
					]) !!}                        
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					{!! Form::submit('確認する', ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
			{!! Form::close() !!}
		</div>
		<hr />
		<br />
		<div class="panel-footer">
		</div>
	</div>
@endsection
