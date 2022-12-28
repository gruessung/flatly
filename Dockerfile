FROM webdevops/php-nginx:8.1

WORKDIR /app

RUN  git clone https://github.com/gruessung/flatly .
#RUN apt update && apt install -y composer
RUN composer install

