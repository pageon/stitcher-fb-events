# Stitcher Facebook events plugin

This plugin adds support to sync events from multiple Facebook pages and show them in a Stitcher project.

```
composer require pageon/stitcher-fb-events
```

```yaml
# Project config file

plugins:
    - Pageon\Stitcher\FbEventsPlugin
```

## Usage

First of all, you'll need to generate a Facebook API access token. A Facebook developer account is required, with a registered app. More info can be found [on the 'Facebook for developers' page](https://developers.facebook.com/apps).

With an app id and an app secret, you'll be able to generate the access token.

```
GET https://graph.facebook.com/oauth/access_token?client_id=APP_ID&client_secret=APP_SECRET&grant_type=client_credentials
```

This token should be added in your project's config file.

```yaml
# config.yml

fb.events.access.token: 1111111111111|adsdbkjabd234234111
```

Next, you'll need to add the [page IDs](https://findmyfbid.com/) you want to sync.

```yaml
# config.yml

fb.events.pages:
    - 147370815293145
    - ...
```

Finally the command to sync facebook events can be run.

```
./stitcher fb:event:sync
```

## Configuration

Besides the access token and page ids, you can also specify how many days in the past and future events should be searched for. 
 These parameters both default to 7. Besides the day limits, you can also configure a file in which Stitcher should save
 the loaded data.
 
```yaml
fb.events.days.past: 7
fb.events.days.future: 7
fb.events.file: data/_fb_events.yml
```

## Usage

After running the `fb:events:sync` command, a file `data/_fb_events.yml` will be available. These entries can be used the 
 same way as any other data file.
  
```yaml
# site.yml

/events:
    template: events
    variables:
        events: data/_fb_events.yml
```

You'd probably want a cronjob or manual trigger to update the data and re-render the events page.
