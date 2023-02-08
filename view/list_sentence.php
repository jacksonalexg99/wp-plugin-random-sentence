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

                        <textarea class="form-control shadow-sm" id="sentence" rows="2" cols="50"
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

<div class="container is mt-2" >

	<?php if ( get_sentence() ): ?>

			<?php foreach ( get_sentence() as $item ): ?>
                <tr>
                    <th scope="row" class=" col-1"><?php echo $item['id'] ?></th>
                    <td id="text-sentence-<?php echo $item['id']; ?>"><?php echo $item['text'] ?></td>
                    <td class="icon col-1">
                        <i class="fas fa-edit edit_sentence" data-id="<?php echo $item['id'] ?>" data-bs-toggle="modal"
                           data-bs-target="#edit"></i>
                        <i class="fas fa-trash  delete_sentence" data-id="<?php echo $item['id'] ?>"></i>
                    </td>
                </tr>
			<?php endforeach; ?>
	<?php else: ?>
        <p class="alert alert-info">هیچ جمله ای برای نمایش وجود نداره , از منو ایجاد جملات تصادفی اولین جمله خودتو ایجاد
            کن.</p>
	<?php endif; ?>
</div>