<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Data Gambar Barang</h3>

      <div class="card-tools">

      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">

      <?php
      if ($this->session->flashdata('pesan')) {
        echo ' <div class="alert alert-success alert-dismissible" role="alert">
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   ';
        echo $this->session->flashdata('pesan');
        echo '</div>';
      }
      ?>
      <table class="table table-bordered" id="example1">
        <thead class="text-center">
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Gambar</th>
            <th>Jumlah</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($gambarbarang as $key => $value) { ?>


            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value->nama_barang ?></td>
              <td class="text-center"><img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" width="100px" height="100px" alt="error"></td>
              <td class="text-center"><?= $value->total_gambar ?></td>
              <td class="text-center">
                <a href="<?= base_url('gambarbarang/add/' . $value->id_barang) ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>Add Gambar</a>
              </td>

            </tr>

          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>