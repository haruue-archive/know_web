# know_web
逼乎APP服务器端源码，原生php。  
没错，就是1个星期的php水平撸的。  
自己写个APP接入本接口玩。  
不要玩坏了。  

###[API](https://github.com/Jude95/know_web/blob/master/api.md)
###[数据库结构](https://github.com/Jude95/know_web/blob/master/sql.sql)

## Haruue 的一点点小修改    
+ 增加并没有什么卵用的 APIKEY 认证功能，被熊孩子调用时返回 404 页面。     
+ 两次 md5 之后再保存密码。    
+ 旧 token 登陆。    

+ [API](https://github.com/haruue/know_web/blob/master/api.md)    
+ [数据库结构](https://github.com/haruue/know_web/blob/master/sql.sql)    

### 其他说明    
+ 数据库配置文件 connect.php    
+ APIKEY 配置文件 check_apikey.php    
