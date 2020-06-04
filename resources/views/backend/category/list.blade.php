@extends('layouts.backend.admin')
@section('content')
<link href="backend/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
<link href="backend/bootstrap-4.css" rel="stylesheet">
<link href="backend/css/plugins/textSpinners/spinners.css" rel="stylesheet">
<link href="backend/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="backend/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<script src="backend/js/plugins/dataTables/datatables.min.js"></script>
<script src="backend/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
<script src="backend/sweetalert2.all.js"></script>
<style>
    #btn-add-modal:hover {
        cursor: pointer;
    }
    .sk-spinner-wave.sk-spinner {
        display: none;
    }
    #cateTable_paginate{
      float: right;
    }
</style>
{{-- <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
      <div class="modal-content animated bounceInRight">
          <form role="form" id="form-add-cate" action="{{ route('admin.categoryAdd.index') }}" method="POST"
              onsubmit="return false;">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                          class="sr-only">Close</span></button>
                  <h4 class="modal-title">Thêm mới</h4>
              </div>
              <div class="sk-spinner sk-spinner-wave">
                  <div class="sk-rect1"></div>
                  <div class="sk-rect2"></div>
                  <div class="sk-rect3"></div>
                  <div class="sk-rect4"></div>
                  <div class="sk-rect5"></div>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                      <label class="control-label">Danh mục</label>
                      <select class="form-control" name="parent_id" id="parent_id" data-rule-required="true"
                          data-msg-required="Vui lòng chọn danh mục.">
                          <option value="" disabled="disabled" selected="selected">--- Chọn ---</option>
                          <option value="0">None</option>
                          {!! $data_select !!}
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Tên danh mục</label>
                      <input type="text" name="name" placeholder="Hãy nhập tên" class="form-control"
                          data-rule-required="true" data-msg-required="Vui lòng nhập tên danh mục."
                          aria-required="true">
                  </div>
                  <input type="hidden" name="kind" value="san-pham">
                  <div class="form-group">
                      <label>Mô tả danh mục</label>
                      <textarea name="description" rows="4" placeholder="Hãy nhập mô tả danh mục"
                          class="form-control" data-rule-required="true"
                          data-msg-required="Vui lòng nhập mô tả danh mục." aria-required="true"
                          name="description"></textarea>
                  </div>
                  <div class="form-group">
                      <label> <input type="checkbox" value="1" checked="" name="status"> Hiển thị</label>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-white" data-dismiss="modal">Đóng</button>
                  <button class="ladda-button ladda-button-demo btn btn-primary" data-style="zoom-in"
                      id="add-cate">Lưu</button>
              </div>
          </form>
      </div>
  </div>
</div> --}}
<div class="row">
    <div class="col-lg-4">
      <div class="wrapper wrapper-content">
        <div class="row">
          <div class="col-md-12">
            <div class="ibox">
              <div class="ibox-title">Thêm danh mục sản phẩm</h5> 
                  <div class="ibox-tools">
                      <a class="collapse-link" href="">
                          <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
              </div>
              <div class="ibox-content">
                <form method="POST" class="frm-cate" id="form-add-cate" onsubmit="return false;">
                    @csrf
                    <input type="hidden" name="id" id="id" value="0">
                        <div class="form-group">
                            <label class="control-label">Danh mục</label>
                            <select class="form-control" name="parent_id" id="parent_id" data-rule-required="true"
                                data-msg-required="Vui lòng chọn danh mục.">
                                <option value="" disabled="disabled" selected="selected">--- Chọn ---</option>
                                <option value="0">None</option>
                                {!! $data_select !!}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" name="name" id="name" placeholder="Hãy nhập tên" class="form-control"
                                data-rule-required="true" data-msg-required="Vui lòng nhập tên danh mục."
                                aria-required="true">
                        </div>
                        <input type="hidden" name="kind" value="san-pham">
                        <div class="form-group">
                            <label>Mô tả danh mục</label>
                            <textarea name="description" id="description" rows="4" placeholder="Hãy nhập mô tả danh mục"
                                class="form-control" data-rule-required="true"
                                data-msg-required="Vui lòng nhập mô tả danh mục." aria-required="true"
                                name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label> <input type="checkbox" value="1" checked="" name="status" id="status"> Hiển thị</label>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="col-md-12 btn btn-primary" id="add-cate">Thêm</button>
                          <button type="button" class="col-md-12 btn btn-warning mt-1" id="reset">Làm mới</button>
                        </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">Danh sách danh mục sản phẩm</h5> 
                          {{-- <span class="label label-primary"
                                id="btn-add-modal" data-toggle="modal" data-target="#myModal">Thêm +</span> --}}
                            <div class="ibox-tools">
                                <a class="collapse-link" href="">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                          
                            <table class="table table-bordered" id="cateTable">
                                <thead>
                                    <tr>
                                        <th>Tên danh mục</th>
                                        <th>Danh mục</th>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '#add-cate', function () {
            $("#form-add-cate").validate({
                submitHandler: function () {
                    var id=$("#id").val();
                    if(id == 0){
                        $.ajax({
                            url: "{{ route('admin.categoryAdd.index') }}",
                            type: "POST",
                            data: $("#form-add-cate").serialize(),
                            dataType: 'JSON',
                            headers: {
                                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                            },
                            success: function (data) {
                                //console.log(data);
                                if (data.status == '_success') {
                                    $('#cateTable').DataTable().ajax.reload();
                                    $("#name").val("");
                                    $("textarea").val("");
                                    $("select").val("");
                                    swal({
                                        title: data.msg,
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        type: 'success',
                                        timer: 2000
                                    });
                                   
                                } else {
                                    swal({
                                        title: data.msg,
                                        type: 'error',
                                        timer: 2000
                                    });
                                }
                            },
                            error: function (err) {
                                console.log(err);
                                swal({
                                    title: 'Error ' + err.status,
                                    text: err.responseText,
                                    type: 'error'
                                });
                            }
                        });
                    }
                    else{
                        $.ajax({
                            url: "{{ route('admin.categoryEdit.index') }}",
                            type: "POST",
                            data: $("#form-add-cate").serialize(),
                            dataType: 'JSON',
                            headers: {
                                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                            },
                            success: function (data) {
                                console.log(data);
                                if (data.status == '_success') {
                                    $("#name").val("");
                                    $("textarea").val("");
                                    $("select").val("");
                                    $('#cateTable').DataTable().ajax.reload();
                                    swal({
                                        title: data.msg,
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        type: 'success',
                                        timer: 2000
                                    });
                                   
                                } else {
                                    swal({
                                        title: data.msg,
                                        type: 'error',
                                        timer: 2000
                                    });
                                }
                            },
                            error: function (err) {
                                console.log(err);
                                swal({
                                    title: 'Error ' + err.status,
                                    text: err.responseText,
                                    type: 'error'
                                });
                            }
                        });
                    }
        
                }
            });
        });
        $(document).on("click",".edit",function() {
            $(this).removeAttr('href');
            var row = $(this);
			var id =  $(this).attr("data-id");
            $("#id").val(id);
            if( $("#id").val == ""){
                $("#add-cate").html('Thêm');
            }
            else{
                $("#add-cate").html('Thay đổi');
            }
            var name = row.closest('tr').find('td:eq(0)').text();
            var parent = row.closest('tr').find('td:eq(1)').children().data('parent_id');
            var description = row.closest('tr').find('td:eq(2)').text();
            var status = row.closest('tr').find('td:eq(3)').children().data('status');
            if(status == 0){
                $("#status").removeAttr("checked");
            }
            $("#parent_id").val(parent);
            $("#name").val(name);
            $("#description").val(description);
            $("#status").val(status);
        });
        $("#myModal").on('hide.bs.modal', function () {
            $("#form-add-cate")[0].reset();
            $("#form-add-cate").validate().resetForm();;
        });
        $("#myModalEdit").on('hide.bs.modal', function () {
          $("#form-add-cate")[0].reset();
          $("#form-add-cate").validate().resetForm();;
        });
    </script>
    <script>
    $(document).on("click","#reset",function(ev) {
            ev.preventDefault();
                $(this).closest('form').find("#id").each(function(i, v) {
                    $(this).val("0");
                });
                $(this).closest('form').find("#name").each(function(i, v) {
                    $(this).val("");
                });
                $(this).closest('form').find("textarea").each(function(i, v) {
                    $(this).val("");
                });
                $(this).closest('form').find("select").each(function(i, v) {
                    $(this).val("");
                });
                $("#add-cate").html("Thêm")
          });
      $(document).ready(function(){
          var table = $('#cateTable').DataTable({
            language: {
                "processing": "Hãy chờ ....",
                "search": "Tìm kiếm",
                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                "info": "Đang hiển thị _PAGE_ của _PAGES_ trang",
                "infoEmpty": "Không có bản ghi nào",
                "zeroRecords": "Không tìm thấy",
            },
            processing: true,
            serverSide: true,
            "ajax": {
              "url": "{!! route('admin.categoryGet.index') !!}",
              dataType: 'JSON'
            },
            columns: [
              {data: 'name', name: 'name'},
              {
                data: 'parent_id',
                name: 'parent_id',
                render: function(data, type, full, meta){
                  if(data == 0){
                    return "<span class='badge badge-primary' data-parent_id="+data+">None</span>";
                  }
                  else{
                    return "<span class='badge badge-danger' data-parent_id="+data+">Con</span>";
                  }
                },
               
              },
              {data: 'description', name: 'description'},
              {
                data: 'status',
                name: 'status',
                render: function(data, type, full, meta){
                  if(data == 1){
                    return "<span class='badge badge-primary' data-status="+data+">Hiển thị</span>";
                  }
                  else{
                    return "<span class='badge badge-danger' data-status="+data+">Ẩn</span>";
                  }
                },
                orderable: false
               },
              {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
            });
        });
    </script>
    <script>
        $(document).on("click",".delete",function() {
            let id = $(this).attr('data-id');
            Swal({
              title: 'Xác nhận xóa?',
              type: 'error',
              html: '<p>Bạn sắp xóa 1 danh mục</p><p>Bạn có chắn chắn muốn xóa?</p>',
              showConfirmButton: true,
              confirmButtonText: '<i class="ti-check" style="margin-right:5px"></i>Đồng ý',
              confirmButtonColor: '#ef5350',
              cancelButtonText: '<i class="ti-close" style="margin-right:5px"></i> Hủy bỏ',
              showCancelButton: true,
              focusConfirm: false,
              reverseButtons: true
            }).then((result) => {
              if (result.value == true) {
                $.ajax({
                  url: '{{ route('admin.categoryDelete.index') }}',
                  type: 'POST',
                  data: {id: id},
                  dataType: 'JSON',
                  headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                  },
                  success: function(data) {
                    //console.log(data);
                    if(data.status == '_success') {
                      Swal({
                        title: data.msg,
                        showCancelButton: false,
                        showConfirmButton: false,
                        type: 'success',
                        timer: 2000
                      }).then(() => {
                        $('#cateTable').DataTable().ajax.reload();
                      });
                    } else {
                      Swal({
                        title: data.msg,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        type: 'error'
                      });
                    }
                  },
                  error: function(err) {
                    console.log(err);
                    Swal({
                      title: 'Error ' + err.status,
                      text: err.responseText,
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonText: 'OK',
                      type: 'error'
                    });
                  }
                });
              }
              return false;
            });
            return false;
          });
    </script>
    @endsection
