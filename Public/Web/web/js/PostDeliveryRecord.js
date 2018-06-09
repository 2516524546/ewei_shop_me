var btn = document.getElementById('download-btn');

//将要进行多文件下载的mp3文件地址，以组数的形式存起来（这里只例了1个地址）
var mp3arr = ["http://www.jq22.com/img/cs/500x500-1.png"];

function download(name, href) {
    var a = document.createElement("a"), //创建a标签
        e = document.createEvent("MouseEvents"); //创建鼠标事件对象
    e.initEvent("click", false, false); //初始化事件对象
    a.href = href; //设置下载地址
    a.download = name; //设置下载文件名
    a.dispatchEvent(e); //给指定的元素，执行事件click事件
}

//给多文件下载按钮添加点击事件
btn.onclick = function name(params) {
    for (let index = 0; index < mp3arr.length; index++) {
        download('第' + index + '个文件', mp3arr[index]);
    }
}