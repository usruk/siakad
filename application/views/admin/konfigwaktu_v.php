
  <!-- content -->
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-8">
                    <h2>Data Konfigurasi Waktu Minimal</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">This is</a>
                        </li>
                        <li class="active">
                            <strong>Breadcrumb</strong>
                        </li>
                    </ol>
                </div>
                <!-- <div class="col-sm-8">
                    <div class="title-action">
                        <a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                </div> -->
            </div>
            <div class="wrapper wrapper-content">
              <div class="ibox-content">
                <div class="row">
                  <div class="col-md-4">
                    <h3>Tabel Waktu</h3>
                  </div>
                </div><br>
                    <div class="table-responsive">
                      <table class="table table-bordered" >
                      <thead>
                      <tr>
                          <th width="5%">No</th>
                          <th width="10%">Jabatan Fungsional</th>
                          <th width="10%">Jam Hadir Minimal</th>
                          <th width="10%">Pengajaran</th>
                          <th width="10%">Pembimbingan</th>
                          <th width="10%">Pengujian</th>
                          <th width="10%">Penelitian dan Pengabdian</th>
                          <th width="10%">Kegiatan Penunjang</th>
                          <th width="10%">Jumlah</th>
                          <th width="10%">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr class="gradeX">
                          <td>1</td>
                          <td>Asisten Ahli</td>
                          <td>21</td>
                          <td>7.5</td>
                          <td>7.5</td>
                          <td>6</td>
                          <td>15.5</td>
                          <td>1</td>
                          <td>37.5</td>
                          <td>
                            <center>
                              <a class='btn btn-warning btn-xs' title='Edit Data' href='' data-toggle="modal" data-target="#modalEdit"><span class='glyphicon glyphicon-edit'></span></a>
                              <a class='btn btn-danger btn-xs' title='Hapus Data' href='#'><span class='glyphicon glyphicon-trash'></span></a>
                            </center>
                          </td>
                      </tr>
                      <tr class="gradeX">
                          <td>2</td>
                          <td>Lektor</td>
                          <td>17</td>
                          <td>7.5</td>
                          <td>5.5</td>
                          <td>4</td>
                          <td>19.5</td>
                          <td>1</td>
                          <td>37.5</td>
                          <td>
                            <center>
                              <a class='btn btn-warning btn-xs' title='Edit Data' href='' data-toggle="modal" data-target="#modalEdit1"><span class='glyphicon glyphicon-edit'></span></a>
                              <a class='btn btn-danger btn-xs' title='Hapus Data' href='#'><span class='glyphicon glyphicon-trash'></span></a>
                            </center>
                          </td>
                      </tr>
                      <tr class="gradeX">
                          <td>3</td>
                          <td>Lektor Kepala</td>
                          <td>13</td>
                          <td>7.5</td>
                          <td>2.5</td>
                          <td>3</td>
                          <td>23.5</td>
                          <td>1</td>
                          <td>37.5</td>
                          <td>
                            <center>
                              <a class='btn btn-warning btn-xs' title='Edit Data' href='' data-toggle="modal" data-target="#modalEdit1"><span class='glyphicon glyphicon-edit'></span></a>
                              <a class='btn btn-danger btn-xs' title='Hapus Data' href='#'><span class='glyphicon glyphicon-trash'></span></a>
                            </center>
                          </td>
                      </tr>
                      <tr class="gradeX">
                          <td>4</td>
                          <td>Guru Besar</td>
                          <td>9</td>
                          <td>7.5</td>
                          <td>1</td>
                          <td>0.5</td>
                          <td>27.5</td>
                          <td>1</td>
                          <td>37.5</td>
                          <td>
                            <center>
                              <a class='btn btn-warning btn-xs' title='Edit Data' href='' data-toggle="modal" data-target="#modalEdit1"><span class='glyphicon glyphicon-edit'></span></a>
                              <a class='btn btn-danger btn-xs' title='Hapus Data' href='#'><span class='glyphicon glyphicon-trash'></span></a>
                            </center>
                          </td>
                      </tbody>
                      </table>
                    </div>
                </div>
              <br>
            </div>
            <div class="modal inmodal" id="modalEdit" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content animated fadeInDown">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Data Jam Minimal</h4>
                            <small>Pastikan data yang diisi telah sesuai</small>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal">
                            <table class="table" style="margin-top:-10px;">
                              <thead>
                                <tr>
                                  <th>Keterangan</th>
                                  <th></th>
                                  <th width="20%">Jam</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Jam Hadir Minimal<span style="color:red;">*</span></td>
                                  <td>:</td>
                                  <td><input type="number" min="0" max="20" class="form-control" required></td>
                                </tr>
                                <tr>
                                  <td>Pengajaran<span style="color:red;">*</span></td>
                                  <td>:</td>
                                  <td><input type="number" min="0" max="20" class="form-control" required></td>
                                </tr>
                                <tr>
                                  <td>Pembimbingan<span style="color:red;">*</span></td>
                                  <td>:</td>
                                  <td><input type="number" min="0" max="20" class="form-control" required></td>
                                </tr>
                                <tr>
                                  <td>Pengujian<span style="color:red;">*</span></td>
                                  <td>:</td>
                                  <td><input type="number" min="0" max="20" class="form-control" required></td>
                                </tr>
                                <tr>
                                  <td>Penelitian dan Pengabdian<span style="color:red;">*</span></td>
                                  <td>:</td>
                                  <td><input type="number" min="0" max="20" class="form-control" required></td>
                                </tr>
                                <tr>
                                  <td>Kegiatan Penunjang<span style="color:red;">*</span></td>
                                  <td>:</td>
                                  <td><input type="number" min="0" max="20" class="form-control" required></td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
