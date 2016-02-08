#逼乎API文档
Haruue 修改后的 know_web 没有可供测试的服务器。    

###规则
1. 所有接口POST，参数 x-www-form-urlencoded模式，返回json

2. 响应状态：
	+ 200 —— 成功
	+ 400 —— 参数错误
	+ 401 —— 用户认证错误
    + 404 —— apikey 认证错误

3. 为方便开发学习，info输出sql语句
4. 登录后用token代表用户。


###1. 注册
地址：register.php
参数：

>name:  
>password:    
>apikey:

返回：

	{
	    "info": "INSERT INTO person ( name , password ) VALUES ( 'jimm' , '33' )"
	}

###2. 登录
地址：login.php
参数

>name:  
>password:    
>apikey:

返回：

	{
	        "id": "50",
	        "name": "jimm",
	        "face": null,
	        "password": "33",
	        "token": "501343d0d2a14eb67885ee4f8c2ef31d95fb8859"
	}

返回用户信息及token

###3. 修改头像
地址：modifyFace.php
参数

>token:  
>face:    
>apikey:

传用户头像地址。本API不负责图片文件储存，图片储存请右转阿里，七牛。把图片地址穿上来。

返回

	{
	    "info": "UPDATE person SET face = 33333 WHERE id = 50"
	}

###4. 取问题列表
地址：getQuestionList.php
参数

>page:  
>count:可空，每页条数，默认20条。    
>apikey:    

返回

	{
	
        "totalCount": 6,
        "totalPage": 1,
        "questions": [
            {
                "id": "70",
                "title": "为什么欧洲各国都在争夺人民币离岸中心？",
                "content": "最近在欧洲除了英国，德国法国也都加入人民币离岸中心的争夺，而早前在亚洲像新加坡，香港，日本等地区也有过类似的情况，各国为什么会如此看重？这对各国将产生什么影响？而对中国来说，又该如何选择？",
                "bestAnswerId": null,
                "date": "2015-06-08 19:38:33",
                "recent": "2015-06-10 15:17:04",
                "answerCount": "1",
                "authorId": "58",
                "authorName": "day",
                "authorFace": null
            },
            {
                "id": "75",
                "title": "期末要挂了怎么办？",
                "content": "",
                "bestAnswerId": null,
                "date": "2015-06-10 14:57:30",
                "recent": null,
                "answerCount": "0",
                "authorId": "58",
                "authorName": "day",
                "authorFace": null
            },
            {
                "id": "69",
                "title": "怎样从领导讲话中过滤废话？",
                "content": "非常急，在线等。领导讲了8个小时根本停不下来。",
                "bestAnswerId": null,
                "date": "2015-06-08 17:22:17",
                "recent": "2015-06-10 14:56:37",
                "answerCount": "2",
                "authorId": "58",
                "authorName": "day",
                "authorFace": null
            },
            {
                "id": "74",
                "title": "你为何这么屌？",
                "content": "屌炸了。",
                "bestAnswerId": null,
                "date": "2015-06-10 14:52:36",
                "recent": "2015-06-10 14:52:36",
                "answerCount": "0",
                "authorId": "58",
                "authorName": "day",
                "authorFace": null
            },
            {
                "id": "68",
                "title": "挖掘机技术哪家强？",
                "content": "非常急，在线等！",
                "bestAnswerId": null,
                "date": "2015-06-08 17:17:48",
                "recent": "2015-06-10 14:45:58",
                "answerCount": "1",
                "authorId": "58",
                "authorName": "day",
                "authorFace": null
            }
        ],
        "curPage": "0"
	}

recent表示最近回复时间。没有回复时为null。

###5. 取回答列表
地址：getAnswerList.php
参数：

>page:  
>questionId:  
>count:可空，每页条数，默认20条。  
>desc:可空，是否倒序，填true 或 false    
>apikey:


返回：

	{
	        "totalCount": "2",
	        "totalPage": 1,
	        "answers": [
	            {
	                "id": "42",
	                "content": "hehe",
	                "date": "2015-05-02 16:49:14",
	                "authorId": "21",
	                "authorName": "zhs",
	                "authorFace": null
	            },
	            {
	                "id": "43",
	                "content": "??",
	                "date": "2015-05-02 16:49:20",
	                "authorId": "21",
	                "authorName": "zhs",
	                "authorFace": null
	            }
	        ],
	         "curPage": "0"
	}

###6. 发布问题
地址：question.php
参数：

>title:  
>content:  
>token:    
>apikey:

返回：

	{
	    "info": "INSERT INTO question ( authorId , title , content , date ) \n\tVALUES ( '19' , '这是标题','这是描述',now())"
	}

###7. 发布回答
地址：answer.php
参数：

>questionId:  
>content:  
>token:    
>apikey:

返回：

	{
	    "info": "INSERT INTO answer ( authorId , questionId , content , date ) VALUES ( '34' , '13','hehe',now())"
	}

###8. 旧 token 登陆
以旧的 token 登陆并更新服务器上的 token      
地址：loginWithOldToken.php    
参数：

>token:    
>apikey:

返回：（与登陆类似）
    
    {
            "id": "50",
            "name": "jimm",
            "face": null,
            "password": "33",
            "token": "501343d0d2a14eb67885ee4f8c2ef31d95fb8859"
    }

###9. 上传图片
上传图片，自动压缩和存储    
地址：image_manager/uploadImage.php    
参数：    

>image: 要上传的图片的二进制流    
>use: 用途。 face 或 normal ，影响图片压缩率    
>apikey:    

返回：    

    {
        "server":"http:\/\/example.com\/know_web\/image_manager\/getImage.php",
        "file":"face_b4481dd9da0cca3c598082fff29a2349.png",
        "url":"http:\/\/example.com\/know_web\/image_manager\/getImage.php?file=face_b4481dd9da0cca3c598082fff29a2349.png"
    }

###10. 取得图片
取得上传过的图片，不需要 APIKEY ，直接 GET 即可    
地址：image_manager/getImage.php    
方法：GET    
参数：    

>file: uploadImage.php 返回的文件名
