### 整站源码下载网址：
`https://github.com/wanjunlengfeng/WechatUrlWebSite.git`

```javascript
如果你仅仅使用api，请使用https://github.com/wanjunlengfeng/wechaturlcheckpreventingblockedapi.git
```

### 安装完成后得到的路径：

    如果你的网站前缀是https://www.xxx.com,那么对应的路径是
    网站首页:https://www.xxx.com
    会员中心:https://www.xxx.com/user/
    会员注册:https://www.xxx.com/user/register.html
    会员登陆:https://www.xxx.com/user/login.html
    后台管理:https://www.xxx.com/manage/

### 安装方法：
#### 一、创建一个支持php+apache(nginx)+mysql的虚拟空间
> 虚拟空间必须支持rewrite伪静态

#### 二、虚拟空间绑定域名
#### 三、上传源码到到虚拟空间（支持composer安装和源码上传）
###### 方法（一）composer安装，复制下面的即可自动

>  composer require goodyes/wechat_url_website ^1.1.0

> composer网址:https://packagist.org/packages/goodyes/wechat_url_website

###### 方法（二）、源码上传

> 将源代码上传到空间

#### 四、配置rewrite伪静态
> 1、 如果是nginx，请将根目录下的nginx_rewrite.conf的内容赋值到nginx伪静态配置
> 2、 如果是apache,我们已经为你配置好了.htaccess

#### 五、修改根目录下的agent_lib/defined.php的AGENT_APPID和AGENT_APPKEY

> 免费获取AGENT_APPID和AGENT_APPKEY
> 请到http://www.v94.cn/manage/ 去查看,如果没有，只需要免费申请一个就可以了。申请地址：http://www.v94.cn/get_free_source_code.html