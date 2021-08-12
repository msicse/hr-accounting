
@extends('layout.admin')
@section('title','Accounts | Notes')

@section('styles')
<style>
    .panel-heading {
    padding: 17px;
}

/*!
 * bootstrap-vertical-tabs - v1.1.0
 * https://dbtek.github.io/bootstrap-vertical-tabs
 * 2014-06-06
 * Copyright (c) 2014 Ä°smail Demirbilek
 * License: MIT
 */
.tabs-left, .tabs-right {
  border-bottom: none;
  padding-top: 2px;
}
.tabs-left {
  border-right: 1px solid #ddd;
}
.tabs-right {
  border-left: 1px solid #ddd;
}
.tabs-left>li, .tabs-right>li {
  float: none;
  margin-bottom: 2px;
}
.tabs-left>li {
  margin-right: -1px;
}
.tabs-right>li {
  margin-left: -1px;
}
.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
  border-bottom-color: #ddd;
  border-right-color: transparent;
}

.tabs-right>li.active>a,
.tabs-right>li.active>a:hover,
.tabs-right>li.active>a:focus {
  border-bottom: 1px solid #ddd;
  border-left-color: transparent;
}
.tabs-left>li>a {
  border-radius: 4px 0 0 4px;
  margin-right: 0;
  display:block;
}
.tabs-right>li>a {
  border-radius: 0 4px 4px 0;
  margin-right: 0;
}
.vertical-text {
  margin-top:50px;
  border: none;
  position: relative;
}
.vertical-text>li {
  height: 20px;
  width: 120px;
  margin-bottom: 100px;
}
.vertical-text>li>a {
  border-bottom: 1px solid #ddd;
  border-right-color: transparent;
  text-align: center;
  border-radius: 4px 4px 0px 0px;
}
.vertical-text>li.active>a,
.vertical-text>li.active>a:hover,
.vertical-text>li.active>a:focus {
  border-bottom-color: transparent;
  border-right-color: #ddd;
  border-left-color: #ddd;
}
.vertical-text.tabs-left {
  left: -50px;
}
.vertical-text.tabs-right {
  right: -50px;
}
.vertical-text.tabs-right>li {
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}
.vertical-text.tabs-left>li {
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  -o-transform: rotate(-90deg);
  transform: rotate(-90deg);
}


</style>


@endsection

@section('contentBody')
<h1 class="text-center">Accounting & Bookkeeping</h1>
<div class="card">
    <div class="card-header">
        <h3>Manage Notes</h3>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
            <form action="{{ route('notes.store') }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary  p-10">Add Note</button>
            </form>
            
        </div>
    </div>

    <div class="row" style="min-height:300px;">
        <div  class="col-sm-12">
            <div class="col-xs-3">
                <!-- required for floating -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tabs-left">
                    <?php  $i = 0; ?>
                    @foreach( $notes as $note )
                        <?php  $i++ ; ?>
                    <li class="{{ $i == 1 ? 'active' : '' }}"><a href="#{{ $note->id }}" data-toggle="tab">{{ $note->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-xs-9">
                <!-- Tab panes -->
                <div class="tab-content">
                    <?php  $i = 0; ?>
                    @foreach( $notes as $note )
                        <?php  $i++ ; ?>
                    <div class="tab-pane" id="{{ $note->id }}" class="{{ $i == 1 ? 'active' : '' }}">
                        <form action="{{ route('notes.update',[$note->id]) }}" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control input-sm" name="title" placeholder="title" value="{{ $note->title }}" />
                                </div>
                                    @if ($errors->has('title'))
                                        <p class="text-right text-danger">{{$errors->first('title')}}</p>
                                    @endif
                            </div>

                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="note">Note</label>
                                    <textarea class="form-control" rows="5" placeholder="note......" name="note" id="note">{{ $note->note }}</textarea>
                                </div>
                                @if ($errors->has('note'))
                                 <p class="text-right text-danger">{{$errors->first('note')}}</p>
                                @endif
                            </div>
                            
                            <button class="btn btn-success" type="submit">Save Note</button>

                            <button class="btn btn-danger delete_category pull-right" data-toggle="modal" data-target="#noteDelete" data-note-id="{{ $note->id }}" type="button">Delete Note</button>
                        </form>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>



<!-- Modal Delete Category -->

<div class="modal fade" id="noteDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" class="delete_category_form" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <h3 class="modal-title">Are you sure to delete this information ? </h3>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


@section('scripts')
<script src="{{ url('vendors/bootgrid/jquery.bootgrid.updated.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                //Basic Example
                // $("#data-table-basic").bootgrid({
                //     css: {
                //         icon: 'zmdi icon',
                //         iconColumns: 'zmdi-view-module',
                //         iconDown: 'zmdi-sort-amount-desc',
                //         iconRefresh: 'zmdi-refresh',
                //         iconUp: 'zmdi-sort-amount-asc'
                //     },
                // });

                //Selection
                // $("#data-table-selection").bootgrid({
                //     css: {
                //         icon: 'zmdi icon',
                //         iconColumns: 'zmdi-view-module',
                //         //iconDown: 'zmdi-sort-amount-desc',
                //         //iconRefresh: 'zmdi-refresh',
                //        // iconUp: 'zmdi-sort-amount-asc'
                //     },
                //     selection: true,
                //     multiSelect: true,
                //     rowSelect: true,
                //     keepSelection: true
                // });

                // //Command Buttons
                // $("#data-table-command").bootgrid({
                //     // css: {
                //     //     icon: 'zmdi icon',
                //     //     iconColumns: 'zmdi-view-module',
                //     //     //iconDown: 'zmdi-sort-amount-desc',
                //     //     //iconRefresh: 'zmdi-refresh',
                //     //     //iconUp: 'zmdi-sort-amount-asc'
                //     // }
                //     // formatters: {
                //     //     "commands": function(column, row) {
                //     //         // return "<button type=\"button\" class=\"btn btn-icon command-edit waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button> " +
                //     //         //         "<button type=\"button\" class=\"btn btn-icon command-delete waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></button>";
                //     //     }
                //     // }
                // });

                $( ".delete_category" ).click(function() {
                    var account_id=$(this).data('note-id');
                    var url=location.origin+'/notes/'+account_id;
                    $('.delete_category_form').attr('action',url);
                });

                // $( ".edit_category" ).click(function() {

                //     var account_id=$(this).data('edit-category-id');

                //     var update_url=location.origin+'/in-ex-categories/'+account_id;

                //     var url=location.origin+'/in-ex-categories/'+account_id+'/edit';

                //     $('.edit_category_form').attr('action',update_url);
                            
                //         $.get(url,function(data){
                //             $('#edit-cat-name').val(data['income_name']);
                            
                //         });
                            
                // });

             
            });
            

        </script>
@endsection