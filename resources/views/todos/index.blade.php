@extends('layouts.app')
@section('title', 'todo')

@section('content')

<div class="panel panel-default" style="margin-top: 16px;">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-6"><h3>Todos - index</h3>
            </div>
            <div class="col-sm-6" style="text-align: right;">
                {{ link_to_route('todos.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
            </div>
        </div>  
        <!--
        {{ link_to_route('todos.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
        -->      
    </div>
    <hr class="mb-2 mt-2" />
    <?php //debug_dump($params);
        $key_name = "";
        if(isset($params["name"])){
            $key_name = $params["name"];
        }
    ?>    
    {!! Form::model(null, [
        'route' => 'todos.search_index', 'method' => 'post', 'class' => ''
    ]) !!}        
    <div class="row">
        <div class="col-sm-4">
            {!! Form::text('name', $key_name , [
                'id' => 'chat-name', 'class' => 'form-control search_key' ,
                'placeholder' => '検索キーを入力下さい',
                'style' => 'margin-right : 10px;']) 
            !!}   
            {!! Form::hidden('complete', $complete , []) 
            !!}                      
        </div>
        <div class="col-sm-2">
            {!! Form::submit('検索', ['class' => 'btn btn-outline-primary btn-sm serach_button']) !!}
        </div>
    </div>
    {!! Form::close() !!}
    <hr class="mb-2 mt-2" />
    <!--
    <div class="complete_wrap">
        <?php if((int)$complete == 0){?>
            <a href="/todos?complete=0" class="btn btn-primary btn-sm">未完</a>
            <a href="/todos?complete=1" class="btn btn-outline-primary btn-sm">完了</a> 
        <?php }else{ ?>        
            <a href="/todos?complete=0" class="btn btn-outline-primary btn-sm">未完
            </a>
            <a href="/todos?complete=1" class="btn btn-primary btn-sm">完了 
            </a>
        <?php } ?>        
    </div>
    -->
    <ul class="nav nav-tabs">
        <?php
            $not_complete_active = "";
            $complete_active = "";
            if((int)$complete == 0){
                $not_complete_active = " active";
            }else{
                $complete_active = " active";
            }
        ?>
        <li class="nav-item">
            <a href="/todos?complete=0" class="nav-link <?= $not_complete_active ?>"
                 id="not_complete_tab">
                未完
            </a>
        </li>
        <li class="nav-item">
            <a href="/todos?complete=1" class="nav-link <?= $complete_active ?>"
                 id="complete_tab">
                完了
            </a>
        </li>
    </ul>

    <div class="panel-body">
        <table class="table table-striped todos-table">
            <thead>
                <th>ID</th>
                <th>Title</th>
                <th>Open</th>
                <th>Create</th>
                <th>Action</th>
            </thead>
            <tbody>
            @foreach ($todos as $todo)
            <tr>
                <td class="table-text">{{ $todo->id }}
                </td>
                <td class="table-text">
                    <p class="p_tbl_todo_name mb-0">
                        {{ link_to_route('todos.show', $todo->title, $todo->id) }}
                    </p>
                    <?php if ($todo->complete == 1){ ?>
                        <h5> <span class="badge badge-secondary">完了済</span>
                        </h5>
                    <?php } ?>
                </td>
                <td class="table-text">
                    <a href="/todos/<?= $todo->id ?>"><i class="fas fa-external-link-alt"></i>
                    </a>
                </td>
                <td class="table-text">{{ $todo->created_at->format('Y-m-d') }}
                </td>
                <td class="table-text">
                    <div style="float :left; margin-right :10px">
                        <a href="/todos/<?= $todo->id ?>/edit"
                            class="a_edit_link" 
                            data-toggle="tooltip" title="編集します">
                            <i class="far fa-edit"></i>
                        </a>
                    </div>
                    <!--
                    {{ Form::open(['route' => ['todos.destroy', $todo->id], 
                    'method' => 'delete']) }}
                        {{ Form::hidden('id', $todo->id) }}
                        {{ Form::submit('削除', ['class' => 'btn btn-outline-danger btn-sm']) }}
                    {{ Form::close() }}
                    -->
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <br />
        <!-- paginater -->
        {{ $todos->links() }}        
        <br />
        @include('element.page_info',
        [
            'git_url' => 'https://github.com/kuc-arc-f/lara58a_3todo',
            'blog_url' => 'https://knaka0209.hatenablog.com/entry/lara58_6todo'
        ])        
    </div>
</div>
<!-- -->
<style>
.p_tbl_todo_name{ font-size: 1.4rem; }
.todos-table td{ padding : 8px;}
</style>

@endsection
