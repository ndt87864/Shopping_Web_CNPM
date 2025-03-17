<div class="modal fade" id="staticBackdropUser" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body ">
        <form action="" method="post" enctype="multipart/form-data">
          <?php add_user(); ?>
          <h4>THÊM TÀI KHOẢN</h4>
          <div class="col-md-12">
            <div class="col-md-6">
              <div class="form-group fa fa-file-image">
                <label for="file">Hình ảnh:</label>
                <input type="file" name="file">
              </div>
            </div>
              <div  class="form-group">
              <label class="fa fa-fw fa-group"></label>
              <label for="user_level">Level: </label><br />
              <select name='user_level'>
                <option value='1'>Người dùng</option>
                <option value='2'>Admin </option>
              </select><br />
            </div>
            <div class="form-group">

              <label class="fa fa-transgender-alt"></label>
              <label for="sex">Giới tính :</label><br />
              <input type="radio" name="sex" id="nam" value="nam"><label class="fa fa-mars"> Nam
              </label>
              &ensp;<input type="radio" name="sex" id="nu" value="nu"><label class="fa fa-venus">
                Nữ </label>
              &ensp;<input type="radio" name="sex" id="khac" value="khac"><label class="fa fa-transgender-alt">
                Khác&ensp;</label>
              <br>
            </div>
            <div class="form-group">
              <label class="fa fa-id-card-alt"></label>
              <label for="username">Tên tài khoản</label>
              <input type="text" name="username" class="form-control">

            </div>
            <div class="form-group"><label class="fa fa-fw fa-user"></label>
              <label for="first name">Tên:</label>
              <input type="text" name="first_name" class="form-control"></label>
            </div>
            <div class="form-group">
              <label class="fa fa-fw fa-user"></label>
              <label for="last name">Họ:</label>
              <input type="text" name="last_name" class="form-control"></label>
            </div>
            <div class="form-group">
              <label for="username">Ngày sinh</label>
              <input type="date" name="birthday" class="form-control">
            </div>
            <div class="form-group">
              <label class="fa fa-fw fa-envelope"></label>
              <label for="email">Email</label>
              <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label class="fa fa-fw fa-key"></label>
              <label for="password">Mật khẩu</label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
              <a class="btn btn-danger" href="index.php?users">Hủy</a>
              <input type="submit" name="add_user" class="btn btn-primary pull-right" value="Lưu">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>