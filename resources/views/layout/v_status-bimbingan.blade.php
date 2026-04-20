@if($bimbingan->status == 'disetujui')
    <button class="btn btn-block btn-success btn-xs"><i class="fa-solid fa-check mr-2 w-auto"></i>Disetujui</button>
@elseif($bimbingan->status == 'diproses')
    <button class="btn btn-block btn-primary btn-xs"><i class="fa-solid fa-clock mr-2"></i>Diproses</button>
@elseif($bimbingan->status == 'dikomentari')
    <button class="btn btn-block btn-info btn-xs"><i class="fa-solid fa-comment-dots mr-2"></i>Dikomentari</button>
@endif
