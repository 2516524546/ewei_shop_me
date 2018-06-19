var loadImageFileyi = (function () {
if (window.FileReader) {
var oPreviewImg = null, oFReader = new window.FileReader(),
rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

oFReader.onload = function (oFREvent) {
if (!oPreviewImg) {
var newPreview = document.getElementById("imagePreviewyi");
		//imagePreview
oPreviewImg = new Image();
oPreviewImg.style.width = (newPreview.offsetWidth).toString() + "px";
oPreviewImg.style.height = (newPreview.offsetHeight).toString() + "px";
newPreview.appendChild(oPreviewImg);}
oPreviewImg.src = oFREvent.target.result;};

return function () {
var aFiles = document.getElementById("imageInputyi").files;
		//imageInput
if (aFiles.length === 0) { return; }
if (!rFilter.test(aFiles[0].type)) { alert("You must select a valid image file!"); return; }
oFReader.readAsDataURL(aFiles[0]);}
}
if (navigator.appName === "Microsoft Internet Explorer") {
return function () {
alert(document.getElementById("imageInputyi").value);
  	//imageInput
document.getElementById("imagePreviewyi").filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = 
		//imagePreview
document.getElementById("imageInputyi").value;}
   //imageInput
}
})();

var loadImageFileer = (function () {
if (window.FileReader) {
var oPreviewImg = null, oFReader = new window.FileReader(),
rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

oFReader.onload = function (oFREvent) {
if (!oPreviewImg) {
var newPreview = document.getElementById("imagePreviewer");
		//imagePreview
oPreviewImg = new Image();
oPreviewImg.style.width = (newPreview.offsetWidth).toString() + "px";
oPreviewImg.style.height = (newPreview.offsetHeight).toString() + "px";
newPreview.appendChild(oPreviewImg);}
oPreviewImg.src = oFREvent.target.result;};

return function () {
var aFiles = document.getElementById("imageInputer").files;
		//imageInput
if (aFiles.length === 0) { return; }
if (!rFilter.test(aFiles[0].type)) { alert("You must select a valid image file!"); return; }
oFReader.readAsDataURL(aFiles[0]);}
}
if (navigator.appName === "Microsoft Internet Explorer") {
return function () {
alert(document.getElementById("imageInputer").value);
  	//imageInput
document.getElementById("imagePreviewer").filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = 
		//imagePreview
document.getElementById("imageInputer").value;}
   //imageInput
}
})();

var loadImageFilesan = (function () {
if (window.FileReader) {
var oPreviewImg = null, oFReader = new window.FileReader(),
rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

oFReader.onload = function (oFREvent) {
if (!oPreviewImg) {
var newPreview = document.getElementById("imagePreviewsan");
		//imagePreview
oPreviewImg = new Image();
oPreviewImg.style.width = (newPreview.offsetWidth).toString() + "px";
oPreviewImg.style.height = (newPreview.offsetHeight).toString() + "px";
newPreview.appendChild(oPreviewImg);}
oPreviewImg.src = oFREvent.target.result;};

return function () {
var aFiles = document.getElementById("imageInputsan").files;
		//imageInput
if (aFiles.length === 0) { return; }
if (!rFilter.test(aFiles[0].type)) { alert("You must select a valid image file!"); return; }
oFReader.readAsDataURL(aFiles[0]);}
}
if (navigator.appName === "Microsoft Internet Explorer") {
return function () {
alert(document.getElementById("imageInputsan").value);
  	//imageInput
document.getElementById("imagePreviewsan").filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = 
		//imagePreview
document.getElementById("imageInputsan").value;}
   //imageInput
}
})();

var loadImageFilesi = (function () {
if (window.FileReader) {
var oPreviewImg = null, oFReader = new window.FileReader(),
rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

oFReader.onload = function (oFREvent) {
if (!oPreviewImg) {
var newPreview = document.getElementById("imagePreviewsi");
		//imagePreview
oPreviewImg = new Image();
oPreviewImg.style.width = (newPreview.offsetWidth).toString() + "px";
oPreviewImg.style.height = (newPreview.offsetHeight).toString() + "px";
newPreview.appendChild(oPreviewImg);}
oPreviewImg.src = oFREvent.target.result;};

return function () {
var aFiles = document.getElementById("imageInputsi").files;
		//imageInput
if (aFiles.length === 0) { return; }
if (!rFilter.test(aFiles[0].type)) { alert("You must select a valid image file!"); return; }
oFReader.readAsDataURL(aFiles[0]);}
}
if (navigator.appName === "Microsoft Internet Explorer") {
return function () {
alert(document.getElementById("imageInputsi").value);
  	//imageInput
document.getElementById("imagePreviewsi").filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = 
		//imagePreview
document.getElementById("imageInputsi").value;}
   //imageInput
}
})();





var loadImageFilewu = (function () {
if (window.FileReader) {
var oPreviewImg = null, oFReader = new window.FileReader(),
rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

oFReader.onload = function (oFREvent) {
if (!oPreviewImg) {
var newPreview = document.getElementById("imagePreviewwu");
		//imagePreview
oPreviewImg = new Image();
oPreviewImg.style.width = (newPreview.offsetWidth).toString() + "px";
oPreviewImg.style.height = (newPreview.offsetHeight).toString() + "px";
newPreview.appendChild(oPreviewImg);}
oPreviewImg.src = oFREvent.target.result;};

return function () {
var aFiles = document.getElementById("imageInputwu").files;
		//imageInput
if (aFiles.length === 0) { return; }
if (!rFilter.test(aFiles[0].type)) { alert("You must select a valid image file!"); return; }
oFReader.readAsDataURL(aFiles[0]);}
}
if (navigator.appName === "Microsoft Internet Explorer") {
return function () {
alert(document.getElementById("imageInputwu").value);
  	//imageInput
document.getElementById("imagePreviewwu").filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = 
		//imagePreview
document.getElementById("imageInputwu").value;}
   //imageInput
}
})();






var loadImageFileliu = (function () {   //改改改改改改改改改
if (window.FileReader) {
var oPreviewImg = null, oFReader = new window.FileReader(),
rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

oFReader.onload = function (oFREvent) {
if (!oPreviewImg) {
var newPreview = document.getElementById("imagePreviewliu");    //改改改改改改改改改
		//imagePreview
oPreviewImg = new Image();
oPreviewImg.style.width = (newPreview.offsetWidth).toString() + "px";
oPreviewImg.style.height = (newPreview.offsetHeight).toString() + "px";
newPreview.appendChild(oPreviewImg);}
oPreviewImg.src = oFREvent.target.result;};

return function () {
var aFiles = document.getElementById("imageInputliu").files;     //改改改改改改改改改
		//imageInput
if (aFiles.length === 0) { return; }
if (!rFilter.test(aFiles[0].type)) { alert("You must select a valid image file!"); return; }
oFReader.readAsDataURL(aFiles[0]);}
}
if (navigator.appName === "Microsoft Internet Explorer") {
return function () {
alert(document.getElementById("imageInputliu").value);      //改改改改改改改改改
  	//imageInput
document.getElementById("imagePreviewliu").filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = 
		//imagePreview			 //改改改改改改改改改
document.getElementById("imageInputliu").value;}     //改改改改改改改改改
   //imageInput
}
})();

var loadImageFileqi = (function () {
if (window.FileReader) {
var oPreviewImg = null, oFReader = new window.FileReader(),
rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

oFReader.onload = function (oFREvent) {
if (!oPreviewImg) {
var newPreview = document.getElementById("imagePreviewqi");
		//imagePreview
oPreviewImg = new Image();
oPreviewImg.style.width = (newPreview.offsetWidth).toString() + "px";
oPreviewImg.style.height = (newPreview.offsetHeight).toString() + "px";
newPreview.appendChild(oPreviewImg);}
oPreviewImg.src = oFREvent.target.result;};

return function () {
var aFiles = document.getElementById("imageInputqi").files;
		//imageInput
if (aFiles.length === 0) { return; }
if (!rFilter.test(aFiles[0].type)) { alert("You must select a valid image file!"); return; }
oFReader.readAsDataURL(aFiles[0]);}
}
if (navigator.appName === "Microsoft Internet Explorer") {
return function () {
alert(document.getElementById("imageInputqi").value);
  	//imageInput
document.getElementById("imagePreviewqi").filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = 
		//imagePreview
document.getElementById("imageInputqi").value;}
   //imageInput
}
})();





var loadImageFileba = (function () {
if (window.FileReader) {
var oPreviewImg = null, oFReader = new window.FileReader(),
rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

oFReader.onload = function (oFREvent) {
if (!oPreviewImg) {
var newPreview = document.getElementById("imagePreviewba");
		//imagePreview
oPreviewImg = new Image();
oPreviewImg.style.width = (newPreview.offsetWidth).toString() + "px";
oPreviewImg.style.height = (newPreview.offsetHeight).toString() + "px";
newPreview.appendChild(oPreviewImg);}
oPreviewImg.src = oFREvent.target.result;};

return function () {
var aFiles = document.getElementById("imageInputba").files;
		//imageInput
if (aFiles.length === 0) { return; }
if (!rFilter.test(aFiles[0].type)) { alert("You must select a valid image file!"); return; }
oFReader.readAsDataURL(aFiles[0]);}
}
if (navigator.appName === "Microsoft Internet Explorer") {
return function () {
alert(document.getElementById("imageInputba").value);
  	//imageInput
document.getElementById("imagePreviewba").filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = 
		//imagePreview
document.getElementById("imageInputba").value;}
   //imageInput
}
})();