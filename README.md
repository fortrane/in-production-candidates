# Подбор кандидатов на вакансию по типу личности

## О проекте
"Подбор кандидатов на вакансию по типу личности" - умная платформа для эффективного подбора и анализа команд, повышающая качество найма и оптимизирующая корпоративную динамику. 

Откройте новый подход к подбору персонала с платформой, которая анализирует видео-визитки, выявляет тип личности кандидатов и находит идеальных сотрудников под конкретные вакансии. Работодатели могут выбрать профессию, а система подберет кандидатов с наиболее подходящими личностными чертами. Редактируйте весовые коэффициенты модели OCEAN, собирайте сбалансированные команды, анализируйте существующие и получайте рекомендации для улучшения взаимодействия. Соискатели также могут загрузить визитку, узнать свою личностную характеристику, подходящие профессии и советы для комфортной командной работы.

## Минимальные требования сервера для Web части
- CPU: 2 ядра
- ОЗУ: 2 ГБ
- SSD/HDD: 20 ГБ

## Установка
### Зависимости сервера
Установка производится на любом Linux сервере. В качестве примера рассмотрим установку на Ubuntu 20.04.

#### Обновление системы
```bash
sudo apt update
sudo apt upgrade -y
```

#### Установка Nginx
```bash
sudo apt install nginx -y
```

#### Установка PHP и расширений
```bash
sudo apt install php7.4 php7.4-fpm php7.4-mysql php7.4-xml php7.4-mbstring php7.4-curl -y
```

#### Установка MySQL
```bash
sudo apt install mysql-server -y
sudo mysql_secure_installation
```

#### Дополнительные шаги для настройки PHP
```bash
sudo systemctl start php7.4-fpm
sudo systemctl enable php7.4-fpm
```

#### Настройка Nginx для работы с PHP
Создайте или отредактируйте конфигурационный файл в /etc/nginx/sites-available/your_domain с следующим содержимым:
```nginx
server {
    listen 80;
    server_name your_domain.com www.your_domain.com;

    root /var/www/your_domain;
    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php7.4-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}

```

#### Перезапуск Nginx

```bash
sudo nginx -t
sudo systemctl restart nginx
```
### Установка Web части
1. Скачайте контент из папок `web` и `database`.
2. Переместите контент папки `web` в корень вашего сайта.
3. Создайте новую базу данных и импортируйте в неё дамп из папки `database`.
4. Откройте файл `src/Custom/Medoo/connect.php` и укажите параметры подключения к базе данных:
    ```
    $pdo = new PDO('mysql:dbname=DB_NAME;host=localhost', 'DB_USR', 'DB_PWD');
    ```
5. Откройте файл `src/Api/v1.php` и укажите URL вашего приемного ML API, а так же секретные ключи для доступа к эндпоинтам отправки и приема данных:
    ```
    $apiUrl = "YOUR_URL_HERE";
    $secretKey = "SECRET_KEY_1";
    $secretPythonKey = "SECRET_KEY_2";
    ```

## Запуск
После установки и настройки всех компонентов, откройте сайт из корня сервера для доступа к Web части. На странице авторизации доступны стартовые данные для двух типов учетных записей. У каждой роли доступны свои страницы. 

Со стороны кандидата: вы можете загружать свои видео-визитки, получать метрику OCEAN, рекомендованную профессию, просматривать видео, редактировать, удалять видео-визитки, менять данные аккаунта, а так же просматривать свой тип личности.

Со стороны работодателя: вы можете загружать свои видео-визитки, получать метрику OCEAN, рекомендованную профессию, просматривать видео, редактировать, удалять видео-визитки, менять данные аккаунта, создавать, редактировать, удалять новых пользователей, составлять команды кандидатов, искать кандидата на конкретную вакансию, просматривать все видео-визитки, управлять ими.

## Минимальные требования сервера для ML части
- CPU: 2 ядра
- ОЗУ: 2 ГБ
- GPU: Опционально (В коде есть документация по смене девайсов)
- SSD/HDD: 10gb

## Установка audio_video
### Начальные настройки
- Установите зависимости из requirements.txt
- В файле config.py установите url вашего сервера с nlp частью
- В файле config.py установите ваш ключ авторизации

### Запуск
Запускаем из папки '/audio_video' в cmd "uvicorn app.main:app --host ваш_хост --port ваш_порт"
Теперь по адрессу http://ваш_хост:ваш_порт/docs доступна документация swagger
в /temp сохраняются видеофайлы, в app/utils/neural_audio_video хранятся веса, код запуска нейросети ocean predict по аудио и видео, ipynb файл с обучением моделей на датасете.
  

## Установка nlp_method
### Начальные настройки
- Установите зависимости из requirements.txt
- В файле config.py установите url вашего frontend
- В файле config.py установите ваш ключ авторизации
- Запустите main.py
 

