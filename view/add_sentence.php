<div class="container  mt-2 is">
    <h3>ایجاد جملات</h3>
    <div class="row  justify-content-center mt-4">
        <div class="col-md-6 ">
            <form action="" id="add_form_sentence">
                <textarea class="form-control shadow-sm" id="sentence" rows="2" cols="50" name="sentence" placeholder="جمله خود را قرار دهید... "></textarea>
                <input type="submit" class="btn btn-success  mt-2 w-100 shadow-sm" id="add_sentence" name="btn" value="اضافه کردن">
                <div class="text-center mt-1 load_add">
                    <i class="fas"></i>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade is " id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="" id="form_update_sentence">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">ویرایش </h3>

                </div>
                <div class="modal-body">
                    <div class="load text-center">
                        <i class="fas fa-spinner fa-spin fs-2 mt-5" style="color:#505050;"></i>

                        <textarea class="form-control shadow-sm" id="sentence_text" rows="2" cols="50"
                                  name="sentence"></textarea>
                    </div>
                    <input type="hidden" id="id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">ویرایش</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container is mt-2"  >
    <h3>لیست جملات</h3>
    <div>
        <table class="table list_sentence table-hover mt-4">
            <thead>
            <tr>
                <th scope="col">شناسه</th>
                <th scope="col">متن</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody id="ks_data">
            <?php include  RS_PLUGIN_DIR.'view/list_sentence.php';
            ?>
            </tbody>
        </table>
    </div>
</div>

