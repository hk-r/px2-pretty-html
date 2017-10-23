px2-pretty-html
======================

[Pickles 2](http://pickles2.pxt.jp/) 用のプラグインです。
HTMLのインデントを整形します。

## 導入手順 - Setup

### 1. `composer.json` に `hk-r/px2-pretty-html` を設定する

`require` の項目に、`hk-r/px2-pretty-html` を追加します。

```
{
	〜 中略 〜
    "require": {
        "php": ">=5.3.0" ,
        "pickles2/px-fw-2.x": "^2.0",
        "hk-r/px2-pretty-html": "^1.0"
    },
	〜 中略 〜
}
```


### 2. composer update を実行する

追加したら、`composer update` を実行して変更を反映することを忘れずに。

```
$ composer update
```


### 3. `config.php` に、設定を追加する

設定ファイル `config.php` (通常は `./px-files/config.php`) を編集します。

- htmlインデント整形の処理追加  
`$conf->funcs->processor->html` に、処理 `'hk\pickles2\prettyHtml\prettyHtml::exec'` を追加します。
```php
	$conf->funcs->processor->html = array(
		// htmlのインデントを整える
		'hk\pickles2\prettyHtml\prettyHtml::exec('.json_encode(array(
			// インデントに使用する文字を指定
			'indentation_character'=>"\t"
		)).')' ,
	);
```

- オプション  
**indentation_character** - インデントに使用する文字を指定します。  
 オプションを指定しない場合はデフォルト(半角スペース2つ)がインデントとして挿入されます。  
 例) タブ  
```php
	// タブがインデントとして挿入されます。
	'indentation_character'=>"\t"
```
 例) 半角スペース4つ  
```php
	// 半角スペース4つがインデントとして挿入されます。
	'indentation_character'=>"    "
```
**exclusion_elements** - インデント対象外のエレメントを指定します。  
 例) textarea, pre  
```php
	// インデント対象外のエレメントを指定します。
	'exclusion_elements'=>array(
		'textarea', 'pre'
	),
```
**inline_elements** - インラインとして扱うエレメントを指定します。  
 例) b, big, i, small, tt, abbr, acronym, cite, code, dfn, em, kbd, strong, samp, var, a, bdo, br, img, span, sub, sup
```php
	// インラインとして扱うエレメントを指定します。
	'inline_elements'=>array(
		'b', 'big', 'i', 'small', 'tt', 'abbr', 'acronym', 'cite', 'code', 'dfn', 'em', 'kbd', 'strong', 'samp', 'var', 'a', 'bdo', 'br', 'img', 'span', 'sub', 'sup'
	),
```

## 更新履歴 - Change log

### hk-r/px2-pretty-html 1.0.0 (2017年xx月xx日)

- Initial Release.


## ライセンス - License

MIT License


## 作者 - Author

- (C)Kyota Hiyoshi <hiyoshi-kyota@imjp.co.jp>


## for Developer

### Test

```
$ ./vendor/phpunit/phpunit/phpunit
```
