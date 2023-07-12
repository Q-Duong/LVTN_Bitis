@foreach ($getAllImportOrderDetail as $key => $import_order_detail)
    <div class="form-group detail-item">
        <div class="row">
            <div class="col-lg-2">
                <label for="exampleInputEmail1">
                    Danh mục: <span class="name-title"></span>
                </label>
            </div>
            <div class="col-lg-3">
                <label for="exampleInputEmail1">
                    Loại sản phẩm: <span class="name-title" ></span>
                </label>
            </div>
            <div class="col-lg-5">
                <label for="exampleInputEmail1">
                    Sản phẩm: <span class="name-title"></span>
                </label>
            </div>
            <div class="col-lg-1">
                <label for="exampleInputEmail1">
                    Màu: <span class="name-title"></span>
                </label>
            </div>
            <div class="col-lg-1">
                <label for="exampleInputEmail1">
                    Size: <span class="name-title"></span>
                </label>
            </div>
        </div>
        <div class="section-input">
            <div class="section-quantity">
                <strong>Số lượng:</strong><input type="text" name="receiver_first_name" class="form-control"
                    value="">
            </div>
            <div class="section-price">
                <strong>Giá tiền:</strong><input type="text" name="receiver_first_name" class="form-control"
                    value="">
            </div>
        </div>
    </div>
@endforeach
