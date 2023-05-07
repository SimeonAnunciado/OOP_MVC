<div class="content-wrapper" style="min-height: 1604.45px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Projects</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Projects</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body p-0">
              <div class="card-header">
                <h3 class="card-title">Page Details </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="#">
                <input type="hidden" name="page_id" value="<?= $data->id ?? null ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter email" value="<?= $data->title ?? '' ?>">
                  </div>
                  <div class="form-group">
                    <label >Content</label>
                    <textarea class="form-control" name="content" placeholder="Password"><?= $data->content ?? '' ?></textarea>
                  </div>

                  <button type="submit" name="submit" class="btn btn-md btn-primary" style="width:100%;">Update</button>

                </div>
                <!-- /.card-body -->


              </form>
            </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>