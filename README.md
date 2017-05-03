# Stitcher Facebook events plugin

This plugin adds support to sync events from multiple Facebook pages and show them in a Stitcher project.

```
composer require pageon/stitcher-fb-events
# Project config file
```

```yaml
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