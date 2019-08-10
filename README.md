
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

# 不死鸟防封系统的优点
### 第一家也是唯一一家彻底开放技术能力的公司

> 这是一个上亿美金的市场，为苦于没有开发和升级能力的创业者提供帮助。

### N种前端模板

> 我们的技术团队打造了10多个前端UI模板，拿来即用。如果你觉得我们的UI不符合你，完全可以自定义前端UI

### 完善的支付体系

> 电脑支付宝，手机支付宝，微信支付已经完美支持。你完全可以用自己的支付APPID，钱瞬间到你的账户

### 强大的技术团队支持

> 随着微信封杀越来越严格，未来防封杀市场一个超过1亿美金朝阳行业，把握先机，你就成把握财富。我们强大的技术开发团队，为你财富保驾护航。

>QQ:1903847062   微信:goodyesw

http://www.v94.cn/get_free_source_code.html
