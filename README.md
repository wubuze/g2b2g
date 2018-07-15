# g2b2g

* 中文简体和繁体互转

1. 安装 

composer require wubuze/g2b2g:dev-master

建议使用国际镜像  composer require wubuze/g2b2g

"repositories": {
        "packagist": {
            "type": "composer",
            "url": "https://packagist.org"
        }    
}

2. 使用

* 简体 -> 繁体  
 
  $ufff =  new \G2B2G\Ufff();
  return $ufff->gb2312_big5('简体中文字符串');

* 繁体 -> 简体

  return $ufff->big5_gb2312('繁体体中文字符串');
  
3. File 文件上传模块使用方法

* composer require wubuze/g2b2g:dev-master
 
 app\config\app.php 文件中provider 加上
 
 G2B2G\UfffServiceProvider::class,
 
 
* php artisan vendor:publish
 
 生成的storage.php 文件里面可以配置文件上传路径
 
 php artisan storage:link  


* 迁移数据库,创建model

 php artisan migrate  生成表 file、file_group
 
 创建 App\Model\File  必须继承 G2B2G\Model\File\File
 创建 App\Model\FileGroup 继承 G2B2G\Model\File\FileGroup
 
* 上传文件
 use G2B2G\File\Uploader;
 
 $module = config('storage.'.$req->input('module'));
 if (!$module) {
     return 'error';
 }

 Uploader::init($req->file('file'));
 $file = Uploader::upload($module['dir'], $req->input('fileName'), $module['public']);
 $file->setUrl();

 return @[
         'id' => $file->id,
         'url' => $file->url,
         'top' => $file->top,
         'name' => $file->file.'.'.$file->type,
     ];
 
 
 
 
 


