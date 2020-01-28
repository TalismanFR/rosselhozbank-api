Библиотека для работы с API Россельхозбанка по передачи лидов на рко.
===

По сути это веб [страница](https://www.rshb.ru/promo/smb/rko-partner/).

Библитека позволяет автомазировать отправку лидов через бекенд.

## Использование
Сама форма отправляет много параметров, но многие из них константные или не обязательыне.

###Быстрый старт:
```php
//формируем объект запроса
/**
* Можно использовать конструктор для полного контроля всех параметров.@api 
 * Ниже представлен фабричный метод который создает объект `Request` с минимальным 
 * достаточным набором данных
 */
/** @var \talismanfr\rosselhozbank\dto\Request $request */
$request=Request::simpleCreate(12345678, 'ООО ТЕСТОВАЯ МЯСОРУБКА',
            new \talismanfr\rosselhozbank\shared\InnValue('701771570807'),
            'ООО РОГА И КОПЫТА','Петров Владислав Юсупович',
            new \talismanfr\rosselhozbank\shared\PhoneValue('+79675319122'),null,
            new \talismanfr\rosselhozbank\dto\RegionBranch(1674,'Санкт-Петербургский филиал','Санкт-Петербург'),
            'comment');

//получаем компонент апи
/** @var \talismanfr\rosselhozbank\Api $api */
$api=new Api();

//отправляем запрос на заявку
/** @var \talismanfr\rosselhozbank\shared\CurlResponse $response */
$response=$api->sendRequest($request);

//тело ответа возращается как есть, без десирилизации и пр.
echo $response->getBody();
```

### Проверка ИНН
```php
$inn=new \talismanfr\rosselhozbank\shared\InnValue('253716541797');

//получаем компонент апи
/** @var \talismanfr\rosselhozbank\Api $api */
$response=$api->innCheck($inn);

//тело ответа возращается как есть, без десирилизации и пр.
echo $response->getBody();
```

Обязательным параметром является код региона (причем внутрений банка) и название региона.
Для его задачи используется объект `\talismanfr\rosselhozbank\dto\RegionBranch`.

Можно получить список кодов через [url](https://www.rshb.ru/promo/smb/rko-partner/js/region.json).

Для упрощения работы с отделениями описал контракт на хранилище и реализацию с использование этой самой ссылки.

```php
/**
*  Реализует контракт RegionBranchStore
 */
$store=new \talismanfr\rosselhozbank\stores\RegionBranchStoreUrlJson(null);

$all=$store->findAll();

foreach ($all as $branch){
    echo $branch->getBranchName().' '.$branch->getId().PHP_EOL;
}
```
В своем DI контейнеры может подменить реализацию на что-то своё и брать из базы или кэша.