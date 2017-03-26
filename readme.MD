# Feed Excerpts for Bloglovin

This plugin helps you force Bloglovin' to receive excerpts in your RSS feed, without needing to adjust your settings globally. This is useful if you want Feedly and other more reputable RSS readers to receive full posts, but Bloglovin' to receive excerpts only.

## Instructions

Install and activate this plugin. This will create a second RSS feed that shows excerpts only.

Go to Settings > Permalinks to refresh your permalinks. The feed will now be available at `yoursite.com/feed/excerpts`.

Then, you need to redirect Bloglovin' to this new version of your feed. If using nginx, add this code to your `server` block:

```
if ( $http_user_agent ~* 'Bloglovin' ) {
    rewrite ^/feed/?$ https://yoursite.com/feed/excerpts/ redirect;
}
```

Replace `yoursite.com` with your own site URL.

The above code is for a 302 redirect. Change `redirect` to `permanent` if you want a 301 redirect. I recommend using `redirect` at first and confirm it works before changing to a 301.