@extends('layouts.app')
@section('title', 'BBS')

@section('content')

<div class="panel panel-default" style="margin-top: 16px;" id="app">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-4"><h3>BBS - index</h3>
			</div>
			<div class="col-sm-4">
				{{ link_to_route('bbs.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
			</div>
			<div class="col-sm-4" style="text-align: right;">
				<?php if((int)$display_mode == 1){ ?>
					<a href="#" class="btn btn-sm btn-outline-primary serach_display_btn mb-0">
						<i class="fas fa-arrow-down"></i>&nbsp;Search
					</a>				
				<?php } ?>
			</div>
		</div>
	</div>
    <?php //debug_dump($params);
        $key_name = "";
        if(isset($params["title"])){
            $key_name = $params["title"];
        }
    ?>    
    {!! Form::model(null, [
        'route' => 'bbs.search_index', 'method' => 'post', 'class' => ''
	]) !!}        
	<div class="search_wrap mt-2" style="display: none; ">
		<hr class="mb-2 mt-2" />
		<div class="row mb-2">
			<div class="col-sm-4">
				{!! Form::text('title', $key_name , [
					'id' => 'chat-name', 'class' => 'form-control search_key' ,
					'placeholder' => 'title',
					'style' => 'margin-right : 10px;']) 
				!!}   
			</div>
			<div class="col-sm-8">
				{!! Form::submit('Search', ['class' => 'btn btn-outline-primary btn-sm serach_button']) !!}
			</div>
		</div>
	</div>
	{!! Form::close() !!}
	<!-- tab -->
    <ul class="nav nav-tabs">
        <?php
            $mode_all_active = "";
            $mode_user_active = "";
            if((int)$display_mode == 2){
                $mode_user_active = " active";
            }else{
                $mode_all_active = " active";
            }
        ?>
        <li class="nav-item">
            <a href="/bbs?mode=1" class="nav-link <?= $mode_all_active ?>"
                 id="not_complete_tab">
                ALL
            </a>
        </li>
        <li class="nav-item">
            <a href="/bbs?mode=2" class="nav-link <?= $mode_user_active ?>"
                 id="complete_tab">
                YourPost
            </a>
        </li>
    </ul>
	<div class="panel-body">
		<table class="table table-striped bbs-table">
			<tbody>
				@foreach ($bbs_posts as $post )
					<tr>
						<td class="table-text">
							<p class="p_tbl_task_name mb-0">
								{{ link_to_route('bbs.show', $post->title, $post->id) }}
							</p>
							<?php if($post->display == 0 ){ ?>
								<span class="badge badge-secondary" style="font-size: 1.2rem;">非表示
								</span>
							<?php } ?>
							<?= $post->created_at ?>, <?= $post->user_name ?> ,ID: <?= $post->id ?>
							<?php if((int)$display_mode == 2){ ?>
								&nbsp;&nbsp;
								<a href="/bbs/<?= $post->id ?>/edit"
									class="a_edit_link" 
									data-toggle="tooltip" title="編集します">
									<i class="far fa-edit"></i>
								</a>
							<?php } ?>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<!-- paginater -->
		{{ $bbs_posts->links() }}
		<br />
		<hr />
		@include('element.page_info',
		[
			'git_url' => 'https://github.com/kuc-arc-f/lara58a_8bbs',
			'blog_url' => 'https://knaka0209.hatenablog.com/entry/lara58_27bbs'
		])        
	</div>
</div>
<!-- -->
<style>
.p_tbl_task_name{ font-size: 1.2rem; }
.bbs-table td{ padding : 8px;}
.bbs-table  td i {font-size : 1.2rem; }
</style>
<!-- -->
<script>
$(function(){
	$( '.serach_display_btn' ).click( function() {
		// alert('serach_display_btn');
		$('.search_wrap').css('display','inherit');
	});
});
</script>

@endsection

