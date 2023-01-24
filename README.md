# flatly - another markdown website system

Flatly is a PHP based blog system that does not require a database.

In the background, the necessary content is stored in Markdown files and read and parsed at runtime.

Flatly is not a static site generator, the website is always generated on call. 

Flatly is /not/ a content management system with a backend.

You have to provide your content on the file system with Markdown and some FrontYAML attributes. Whether you do this manually or via a pipeline....that's up to you.

Flatly is based on PHP8, Symfony and Twig. You can easily customize the default template in the template folder.

## docker-compose example quick-start
[![Docker](https://github.com/gruessung/flatly/actions/workflows/docker-publish.yml/badge.svg)](https://github.com/gruessung/flatly/actions/workflows/docker-publish.yml)
```
version: '3.3'
services:
  flatly:
    ports:
      - '8094:80'
    environment:
      - WEB_DOCUMENT_ROOT=/app/public # do not change
    volumes:
      - './data:/data/'
    image: ghcr.io/gruessung/flatly:master
   ```
**Please note that your local data directory has write permissions for the container.**

## example config.json
```
todo
```
