@extends('layouts.adminlte')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <h1>
        General Form Elements
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section> -->

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">สติ๊กเกอร์ไลน์ (เพิ่มแท็ก,คำค้นหา)</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {{Form::open(array('url'=>'creator/sticker/save', 'method'=>'post', 'class'=>'','id'=>'stickerFrm'))}}
              <div class="box-body">

                @if(count($errors))
                  <div class="alert alert-danger">
                    <strong>อุ๊บส์!</strong> ไม่สามารถบันทึกข้อมูลได้เนื่องจาก...
                    <br/>
                    <ul>
                      @foreach($errors->all() as $error)
                      <li>{!! $error !!}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                
                @foreach($image as $key=>$row)
                  <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="img-cover">
                        <img src="{{ $row }}" height="120" width="120">
                        </div>
                        <textarea name="tag[]" style="width:100%;">{{ $key }}</textarea>
                      </div>
                    </div>
                  </div>
                @endforeach
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-info pull-right">บันทึกข้อมูล</button>
              </div>
              <!-- /.box-footer -->
            {{Form::close()}}
          </div>
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
