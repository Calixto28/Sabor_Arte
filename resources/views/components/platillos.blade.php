@foreach($items as $item)
<div class="cntainer">
  <div class="card1">
  <img class="imgp" src="{{ $item['ImagenPlatillo'] }}">
    <div class="overlay">  
    <img class="imgp2" src="{{ $item['ImagenPlatillo'] }}">
      <div class = "items">
      </div>
        <div class = "items head">
          <p>{{ $item['NombrePlatillo'] }}</p>
          <hr>
        </div>
        <div class = "items price"> 
          <br>
          <p class="new">{{ $item['precio'] }}</p>
        </div>
    </div>
  </div>
</div>
@endforeach