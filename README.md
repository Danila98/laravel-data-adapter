Установка
------------
Данный пакет реализует шаблон адапртер для формирования ответа в формате json из фремворка laravel

Установка
------------

### Install via Composer

Установить пакет можно добавив в ваш composer.json следующие строки

~~~
    "require": {
        "kiryanov/adapter" : "*"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Danila98/laravel-data-adapter"
        }
    ]
~~~

Использование
------------

Для использования вам необходимо в вашем проекте создать адаптер для конкретной модели, и реализовать там данный метод.
Например модель цвета, который является сущьностью eloquent и сформировать ассоциативный массив 
с теми полями, которые хотите отправить из контроллера. 
Метод getChildrenModel нужен в том случае, если в у вас есть связанные модели,
в него следует передать эти модели и адаптер для них

~~~

class ColorAdapter extends DataAdapter
{

    /**
     * @param Color $color
     */
    public function getModelData(Model $color) : array
    {
        return [
            'image' => $color->image,
            'color_name' => $color->color_name,
            'tags' => $this->getChildrenModel($color->tags, TagAdapter::class)
        ];
    }

}

~~~

В контроллере его следует использовать подобным образом 
~~~
public function getRandomColor(ColorAdapter $adapter)
{

    $random_color = Color::orderBy(DB::raw('RAND()'))->take(1)->first();
    return $adapter->getModelData($random_color);

}
~~~

Массив моделей
------------

Если же у вас массив или коллекция моделей воспользутесь методом getArrayModelData
~~~
public function getAllColor(ColorAdapter $adapter)
{

    $colors = Color::all();
    return $adapter->getArrayModelData($colors);

}
~~~
