# g2b2g

* 中文简体和繁体互转

1. 安装 

composer require wubuze/g2b2g

建议使用国际镜像  composer require wubuze/g2b2g

"repositories": {
        "packagist": {
            "type": "composer",
            "url": "https://packagist.org"
        }    
}

2. 使用

* 简体 -> 繁体  
 
  $ufff =  new \Wubuze\G2B2G\Core();
  return $ufff->gb2312_big5('简体中文字符串');

* 繁体 -> 简体

  return $ufff->big5_gb2312('繁体体中文字符串');
  

 
 
 # 66666
 
 
 
 
 


