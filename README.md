# twitter-likes

Download your twitter likes using an enhanced version of https://gist.github.com/datagrok/74a71f572493e603919e

## prereqs

* Install python 3
* Install gdbm: `brew install gdbm`
* Create an application at [apps.twitter.com](https://apps.twitter.com)
* Create `creds.py` with the following from your application

```
username = "datagrok"
consumer_key = "..."
consumer_secret = "..."
access_token = "..."
access_token_secret = "..."
```

* `make venv` to create the virtual env

## commands

`make fetch` downloads favs to favs.db and favs.ndjson  
`make dump` extract favs from favs.db to stdout  
`make` to show all options

`python get_favs.py` to download all favs.
`python get_favs.py 25092021` (in DDMMYYYY format) to download only from recent to that past day.
The new get_media.php downloads all media from your favs twits. `php get_media.php` after downloading the favs.ndjson 

## download media: pics, gif and videos
Once we have downloaded the likes and we have the favs.ndjson file, we can run get_media.php with PHP8.

## alternatives

[IFTTT](https://ifttt.com/applets/113241p-save-the-tweets-you-like-on-twitter-to-a-google-spreadsheet) - however it won't log tweets older than the previous liked tweet (eg: a tweet from 2018 if the last liked tweet was in 2019). I'm assuming it's using the `since_id` filter of the last recorded tweet when calling the [favourites api](https://developer.twitter.com/en/docs/tweets/post-and-engage/api-reference/get-favorites-list).

[dogsheep/twitter-to-sqlite](https://github.com/dogsheep/twitter-to-sqlite) - save favourites (and other things) to sqllite. Has the same API limits of max 3170 tweets at a time.

