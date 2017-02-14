{{-- 模态框（Modal）开始 --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalTitle">

                </h4>
            </div>
            <div class="modal-body"  id="myModalBody">
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="id">id</label>
                            </div>
                            <div class='col-md-8'>
                                <input type='text' class='form-control' name="id" id='id' readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">name</label>
                            </div>
                            <div class='col-md-8'>
                                <input type='text' class='form-control' name="name" id='name'>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="submit" id="submit-modal" class="btn btn-primary">提交更改</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div> {{-- 模态框（Modal）结束 --}}