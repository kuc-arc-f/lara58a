@extends('layouts.app')

@section('title', "edit")

@section('content')

	<div class="panel panel-default">
		<br />
		<div class="panel-heading">
				{{ link_to_route('bbs.index', '戻る', null, ['class' => 'btn btn-outline-primary'] ) }}
			<hr />
			<h3>BBS 編集</h3>
			<p>
				title : <?= $bbs_post->title ?> <br />
				ID : <?= $bbs_post->id ?> <br />
			</p>
		</div>
		<hr />
		<div class="panel-body">
			{!! Form::model($bbs_post, ['route' => ['bbs.update', $bbs_post->id], 'method' => 'patch', 
			'class' => 'form-horizontal']) !!}
				<div class="col-sm-6 mb-2">
					{!! Form::label('display', '表示/非表示 :',
					 ['class' => 'col-sm-6 control-label']) !!}
					{{ Form::select('display', [
						 '1' => '表示', '0' => '非表示'], 
						 $bbs_post->display, 
						['class' => 'form-control', 'id' => 'type', 'required'=>'required']
					) }}
				</div>            
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6">
						{!! Form::button('<i class="fa fa-save"></i> Save', 
						['type' => 'submit', 'class' => 'btn btn-primary']) !!}
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
