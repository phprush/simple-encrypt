# simple-encrypt

### 使用方式
```
/**
 * Laravel 5 简单的加密插件
 * @exception Exception
 * @return array
 */
```

### 安装方式
```
composer require phprush/simple-encrypt

php artisan vendor:publish --provider="PhpRush\SimplaeEncrypt\SimplaeEncryptServiceProvider"

###### https://d.laravel-china.org/docs/5.5/providers
array_merge(config('app.providers'), [
  PhpRush\SimplaeEncrypt\SimplaeEncryptServiceProvider::class
]);

###### https://d.laravel-china.org/docs/5.5/facades
array_merge(config('app.aliases'), [
  'SimplaeEncrypt' => PhpRush\SimplaeEncrypt\Facades\SimplaeEncrypt::class
]);
```

### 在config/simple_encrypt.php 中使用 env('SIMPLE_ENCRYPT_APP_KEY')/env('SIMPLE_ENCRYPT_APP_SECRET')
```
vim .env
  SIMPLE_ENCRYPT_APP_KEY=xxxxxxxx
  SIMPLE_ENCRYPT_APP_SECRET=xxxxxxxx
```
