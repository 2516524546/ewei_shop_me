var result = document.getElementById("result");
			var input = document.getElementById("file_input");

			// var values=[];   

			function xmTanUploadImg(obj) {
				var result = document.getElementById("result");
				var file_input = document.getElementById("file_input");
					// for(let key in obj.files){
					// 	//只遍历对象自身的属性，而不包含继承于原型链上的属性。  
					// 	if (obj.files.hasOwnProperty(key) === true){
					// 		values.push(obj.files[key]);   
					// 		}  
					// 	}
					// 	console.log(values)

				var fl = obj.files.length;
				for(var i = 0; i < fl; i++) {
					var file = obj.files[i];
					//            判断图片
					if(/image\/\w+/.test(file.type)) {
						var reader = new FileReader();
						reader.readAsDataURL(file);

						//读取文件过程方法
						reader.onerror = function(e) {
							console.log("读取异常....");
						}
						reader.onload = function(e) {
							var imgstr = '<img src="' + e.target.result + '"/>';
							var result = document.getElementById("result");
							var ndiv = document.createElement("div"); //创建div节点 创建外部img-div
							var Cdiv = document.createElement("div");//创建cover遮罩层
							var Cspan = "<img src='./Public/Web/web/img/false.png'>"; //遮罩层框的内容文字
							


							ndiv.innerHTML = imgstr; //img-div框架的拼接
                            ndiv.className = "img-div";	//img-div的类名
                            ndiv.setAttribute("data-isNew","true") //img-div赋予自定义属性
							Cdiv.innerHTML = Cspan; // 遮罩层拼接
							Cdiv.className = "covers"; //遮罩层的类名
							ndiv.appendChild(Cdiv); //遮罩层拼接进去
                            result.prepend(ndiv); //将拼接进去最前面
                            // *删除功能*/
                        $(".covers").click(function() {
                            var _this = $(this);
							$("#file_input").val("");
                            _this.parents(".img-div").remove();
                        });

						}
					} else if(/video\/\w+/.test(file.type)) {
						console.log(file)
						var video = $('#video').find('video');
//						限制上传的图片数
                        var a = $(".img-div").length;
							videoURL = null,
								windowURL = window.URL || window.webkitURL;
							if(file) {

								videoURL = windowURL.createObjectURL(file);
								console.log(videoURL)

								$('#video').html('<video src="' + videoURL + '" controls="controls"></video>');

								setTimeout(function() {
									createIMG(videoURL);
								}, 500);
						}
					}

					function createIMG(url) {
                        var scale = 1,
                        video = $('#video').find('video')[0],
                        canvas = document.createElement("canvas"),
                        canvasFill = canvas.getContext('2d');
						canvas.width = video.videoWidth * scale;
						canvas.height = video.videoHeight * scale;
						canvasFill.drawImage(video, 0, 0, canvas.width, canvas.height);

                        var image = new Image();
                        
                         var src = canvas.toDataURL("image/jpeg");
                         image.src = src;
                        // var imgstr = '<img src="' + src + '"/>';
                        // console.log(imgstr)
						var result = document.getElementById("result");
                        var ndiv = document.createElement("div"); //创建div节点
                        var Cdiv = document.createElement("div");
						var Cspan = "<img src='./Public/Web/web/img/false.png'>"; //遮罩层框的内容文字
						var Pdiv = document.createElement("div");
						var Pimg = "<img src='./Public/Web/web/img/video_paly.png'>";
                        ndiv.appendChild(image)
                        ndiv.className = "img-div";
						ndiv.id = "img-div";
                        ndiv.setAttribute("data-isNew","true");
                        Cdiv.innerHTML = Cspan;
						Cdiv.className = "covers";
						Pdiv.innerHTML = Pimg;
						Pdiv.className = "Play_video";
						ndiv.appendChild(Pdiv);
                        ndiv.appendChild(Cdiv);
						//console.log([result])
						$(".img-div").remove();
                        result.prepend(ndiv);
                         // *删除功能*/
                        $(".covers").click(function() {
							var _this = $(this);
							$("#file_input").val("");
                            _this.parents(".img-div").remove();
						});
						$(".Play_video").click(function(){
							$(".video_box").show();
							$(".shadow_video").show();
							$(".video_box .video_area").html('<video width="100%" height="100%" autoplay=""><source src="'+url+'" type="video/mp4"></source></video>')
						})

						$(".video_box .video_shut").click(function(){
							$(".video_box").hide();
							$(".shadow_video").hide();
							//console.log($(".video_box .video_area video"))
							$(".video_box .video_area video")[0].pause()
							// $(".video_box .video_area .Videos").pause();
						})
                    }
                    
                    
                }
               
            }