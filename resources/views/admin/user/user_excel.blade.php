 <div class="table-responsive">
     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <tr>
             <td colspan="6" rowspan="2" align="center">Rekap Jadwal {{ $user->nama }}</td>
         </tr>
         <tr>
             <td></td>
         </tr>

         <tr>
             <th>No</th>
             <th>Nama</th>
             <th>Nama kegiatan</th>
             <th>Keterangan</th>
             <th>Waktu mulai</th>
             <th>Waktu berakhir</th>
         </tr>
         <tbody>
             @foreach ($jadwal as $item)
                 <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $item->rUser->nama }}</td>
                     <td>{{ $item->title }}</td>
                     <td>{{ $item->keterangan }}</td>
                     <td>{{ $item->start_time }}</td>
                     <td>{{ $item->finish_time }}</td>
                 </tr>
             @endforeach
         </tbody>
     </table>
 </div>
