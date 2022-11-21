@extends('layouts.induk')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark card-title">Pengaduan Progres</h6>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Isi Aduan</th>
                  <th>Tgl. Aduan</th>
                  <th>Tgl. Followup</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($followups as $followup)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $followup->pengaduan->nama }}</td>
                  <td>{{ $followup->pengaduan->isi_aduan }}</td>
                  <td>{{ \Carbon\Carbon::parse($followup->pengaduan->tgl_aduan)->format('d-m-Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($followup->tgl_followups)->format('d-m-Y') }}</td>
                  <td>{{ $followup->pengaduan->status }}</td>
                  <td> @if($followup->pengaduan->status == 'Progres') <button type="button" title="Update" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#CustomerSignature{{ $followup->id }}"><i class="fa fa-edit text-white"></i></button>
                   @endif
                   <a href="/pengaduan/detail/{{ $followup->id }}" title="Detail" class="btn btn-sm btn-secondary"><i class="fa fa-list text-white"></i></a>
                  </td>
                </tr>

                <!-- Modal Signature-->
                <div class="modal fade" id="CustomerSignature{{ $followup->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Signature</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                          <form action="{{ route('simpan.ttd', $followup->id) }}" method="post">
                            @csrf
                              <div class="form-row">
                                <div class="form-group col-md-12">
                                  <label class="" for="sig{{ $followup->id }}">Tanda Tangan Pelapor</label>
                                  <div id="sig{{ $followup->id }}" class="sig"></div>
                                  <textarea id="signature64" class="signature64" name="signed" style="display: none" required></textarea>
                                </div>
                              </div>
                              @if(empty($followup->penyelesaian))
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="penyelesaian">Penyelesaian</label>
                                  <textarea rows="3" class="form-control" id="penyelesaian" name="penyelesaian" required></textarea>
                                </div>  
                              </div>
                              @endif
                              <button type="submit" class="btn btn-success">Save</button>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" id="clear" class="btn btn-warning clear">Clear</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                  </div>
                </div>

                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection

@section('signature-pad')
<script type="text/javascript">
  // for(var id = 0; id < 10; id++){
    var sig = $('.sig').signature({syncField: '.signature64', syncFormat: 'PNG'});
    $('.clear').click(function(e) {
      e.preventDefault();
      sig.signature('clear');
      $(".signature64").val('');
    });
  // }
</script>
@endsection