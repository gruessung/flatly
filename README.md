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
{
  "title": "website title",
  "index_site_type": "blog_list",
  "blog_list": {
    "items_per_page": 10
  },
  "cnt_content_files": 12,
  "imprint": "hlink to imprint",
  "privacy": "link to privacy"
}
```

## example data folder
```
/data
/data/content
/data/content/my-first-post.md
/data/flatly
/data/flatly/config.json (see above)
```
flatly is generating all neccesary files on first call, you only have to provide a valid config.json

## example of my-first-post.md
```
---
title: Flatly und CI/CD
slug: flatly-ci-cd
tags: ["flatly"]
site_type: blog_post
render_type: blog_post
date: 2023-03-20T12:00:00
---

Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
```
