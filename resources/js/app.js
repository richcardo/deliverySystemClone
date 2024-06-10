import './bootstrap';
import jsQR from "jsqr";

var user = document.getElementById('user')
var dropdownMenu = document.getElementById('dropdown-menu')

function dropdownMenuView(){
    if(dropdownMenu.style.display=='none'){
        dropdownMenu.style.display=='block'
    }else {
        dropdownMenu.style.display=='none'
    }
}

user.addEventListener('click', dropdownMenuView());

function FixHover($value){
    if($value=='riders'){
        document.getElementById('riders').classList.add('fixed-hover')
        document.getElementById('deliveries').classList.remove('fixed-hover')
        console.log('riders')
    }else if ($value=='deliveries'){
        document.getElementById('deliveries').classList.add('fixed-hover')
        document.getElementById('riders').classList.remove('fixed-hover')
    }
}

var video = document.createElement("video");
var canvasElement = document.getElementById("canvas");
var canvas = canvasElement.getContext("2d");
var loadingMessage = document.getElementById("loadingMessage");
var outputContainer = document.getElementById("output");
var outputMessage = document.getElementById("outputMessage");
var outputData = document.getElementById("outputData");
var inputName = document.getElementById('name');
var inputNumber = document.getElementById('number');
var inputAddress = document.getElementById('address');
var inputPrice = document.getElementById('price');

function drawLine(begin, end, color) {
  canvas.beginPath();
  canvas.moveTo(begin.x, begin.y);
  canvas.lineTo(end.x, end.y);
  canvas.lineWidth = 4;
  canvas.strokeStyle = color;
  canvas.stroke();
}

// Use facingMode: environment to attemt to get the front camera on phones
navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
  video.srcObject = stream;
  video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
  video.play();
  requestAnimationFrame(tick);
});

function tick() {
  loadingMessage.innerText = "⌛ Loading video..."
  if (video.readyState === video.HAVE_ENOUGH_DATA) {
    loadingMessage.hidden = true;
    canvasElement.hidden = true;
    outputContainer.hidden = true;

    canvasElement.height = video.videoHeight;
    canvasElement.width = video.videoWidth;
    canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
    var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
    var code = jsQR(imageData.data, imageData.width, imageData.height, {
      inversionAttempts: "dontInvert",
    });
    if (code) {
      drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
      drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
      drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
      drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
      outputMessage.hidden = true;
      outputData.parentElement.hidden = false;
      //outputData.innerText = code.data;
      console.log(code.data)
      const parsed = JSON.parse(code.data);

    inputName.value = parsed.name
    inputAddress.value = parsed.address
    inputNumber.value = parsed.number
    inputPrice.value = parsed.price
   
     //let datas = JSON.parse(code.data)

    } else {
      outputMessage.hidden = false;
      outputData.parentElement.hidden = true;
    }
  }
  requestAnimationFrame(tick);
}


