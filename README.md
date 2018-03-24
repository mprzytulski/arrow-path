# Array Path

Simple access array with `->` notation. 


## Examples 

### Basic example

```php
$arrow = new Arrow(['something' => 1]);
echo $arror->something; 
```

Output:
```
1
```

### Use naive mode
```php
$arrow = new Arrow(['something' => 1], true);
echo $arror->something->otherthing; 
```

Output:
```
''
```


### Get original value
```php
$arrow = new Arrow(['something' => 1], true);
var_dump($arror->something()); 
```

Output:
```
int(1)
```
