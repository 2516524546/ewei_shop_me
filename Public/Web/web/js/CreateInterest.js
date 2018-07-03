$(function() {
    $("#pic").click(function() {
        $("#upload").click(); //隐藏了input:file样式后，点击头像就可以本地上传
        $("#upload").on("change", function() {
            var objUrl = getObjectURL(this.files[0]); //获取图片的路径，该路径不是图片在本地的路径
            if (objUrl) {
                $("#pic").attr("src", objUrl); //将图片路径存入src中，显示出图片
                upimg();
            }
        });
    });
});

// $(function() {
    $("#pics").click(function() {
        $("#upload2").click(); //隐藏了input:file样式后，点击头像就可以本地上传
        $("#upload2").on("change", function() {
            var objUrl = getObjectURL(this.files[0]); //获取图片的路径，该路径不是图片在本地的路径
            if (objUrl) {
                $("#pics").attr("src", objUrl); //将图片路径存入src中，显示出图片
                upimgs();
            }
        });
    });
// });

//建立一?可存取到?file的url
function getObjectURL(file) {
    var url = null;
    if (window.createObjectURL != undefined) { // basic
        url = window.createObjectURL(file);
    } else if (window.URL != undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL != undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}
//上传头像到服务器
function upimg() {
    var pic = $('#upload')[0].files[0];
    var file = new FormData();
    // console.log(file)
    file.append('image', pic);
    $.ajax({
        url: "/uploadImg",
        type: "post",
        data: file,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            // console.log(data);
            var res = data;
            $("#resimg").append("<img src='/" + res + "'>")
        }
    });
}

function upimgs() {
    var pic = $('#upload2')[0].files[0];
    var file = new FormData();
    // console.log(file)
    file.append('image', pic);
    $.ajax({
        url: "/uploadImg",
        type: "post",
        data: file,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            // console.log(data);
            var res = data;
            $("#resimgs").append("<img src='/" + res + "'>")
        }
    });
}


// $(function() {
//     $("#pics").click(function() {
//         $("#uploads").click(); //隐藏了input:file样式后，点击头像就可以本地上传
//         $("#uploads").on("change", function() {
//             var objUrl = getObjectURL(this.files[0]); //获取图片的路径，该路径不是图片在本地的路径
//             if (objUrl) {
//                 $("#pics").attr("src", objUrl); //将图片路径存入src中，显示出图片
//                 upimg();
//             }
//         });
//     });
// });

// //建立一?可存取到?file的url
// function getObjectURL(file) {
//     var url = null;
//     if (window.createObjectURL != undefined) { // basic
//         url = window.createObjectURL(file);
//     } else if (window.URL != undefined) { // mozilla(firefox)
//         url = window.URL.createObjectURL(file);
//     } else if (window.webkitURL != undefined) { // webkit or chrome
//         url = window.webkitURL.createObjectURL(file);
//     }
//     return url;
// }
// //上传头像到服务器
// function upimg() {
//     var pic = $('#uploads')[0].files[0];
//     var file = new FormData();
//     file.append('image', pic);
//     $.ajax({
//         url: "/uploadImg",
//         type: "post",
//         data: file,
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(data) {
//             console.log(data);
//             var res = data;
//             $("#resimg").append("<img src='/" + res + "'>")
//         }
//     });
// }