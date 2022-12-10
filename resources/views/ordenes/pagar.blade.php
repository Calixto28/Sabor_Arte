<div class="pagar-view">
    <div class="title-pagar">{{$title}}</div>
    <div class="total-pagar">${{number_format($total,2)}}</div>
    <div class="btn-regresar">
        <a class="btn btn-secondary" href="<?= $session['route'] ?>/ordenes">Regresar</a>
    </div>
</div>