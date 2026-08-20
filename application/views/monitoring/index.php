
          <h1 class="mt-4">Monitoring</h1>
          <hr>

         <img src="<?= base_url('assets/'); ?>image/iwak.PNG" style=" width: 100%;">


            <h3>Controlling</h3>
            <hr>

<div class="d-flex justify-content-center mb-5">
  <div id="container">
    <h2>ESP32-CAM Foto </h2>
    <p>Perlu waktu 5 detik untuk menggambil foto</p>
    <p>
      <button class="btn btn-primary px-5" type="submit" onclick="capturePhoto()">CAPTURE PHOTO</button>
      <button class="btn btn-primary px-5" type="submit" onclick="location.reload();">REFRESH PAGE</button>
    </p>
  </div>
  <div><img src="saved-photo" id="photo" width="70%"></div>
<script>
  var deg = 0;
  function capturePhoto() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', "/capture", true);
    xhr.send();
  }
  function rotatePhoto() {
    var img = document.getElementById("photo");
    deg += 90;
    if(isOdd(deg/90)){ document.getElementById("container").className = "vert"; }
    else{ document.getElementById("container").className = "hori"; }
    img.style.transform = "rotate(" + deg + "deg)";
  }
  function isOdd(n) { return Math.abs(n % 2) == 1; }
</script>

</div>

